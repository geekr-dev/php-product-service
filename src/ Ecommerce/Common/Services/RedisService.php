<?php

namespace Ecommerce\Common\Services;

use Carbon\Carbon;
use Ecommerce\Common\Events\Event;
use Illuminate\Support\Facades\Redis;

class RedisService
{
    const ALL_EVENTS_KEY = 'events';
    const PROCESSED_EVENTS_KEY = '1';

    // 发布新事件
    public function publish(Event $event): void
    {
        Redis::xadd(self::ALL_EVENTS_KEY, '*', [
            'event' => $event->toJson(),
            'service' => $this->getServiceName(),
            'createdAt' => now()->format('Y-m-d H:i:s'),
        ]);
    }

    // 获取未处理事件
    public function getUnprocessedEvents(): array
    {
        $fromTimestamp = $this->getLastProcessedEventId();
        $events = $this->getEventsAfter($fromTimestamp);
        return $this->parseEvents($events);
    }

    // 维护一个已处理事件列表
    public function addProcessedEvent(array $event): void
    {
        Redis::rpush(
            $this->getServiceName() . '-' . self::PROCESSED_EVENTS_KEY,
            $event['id'],
        );
    }

    // 从已处理事件列表获取最后一个事件ID
    public function getLastProcessedEventId(): string
    {
        $lastId = Redis::lindex(
            $this->getServiceName() . '-' . self::PROCESSED_EVENTS_KEY,
            -1,
        );
        return empty($lastId)
            ? (string) Carbon::now()->subYears(10)->valueOf()
            : $lastId;
    }

    // 获取指定 ID 之后的事件 
    public function getEventsAfter(string $start): array
    {
        /** @phpstan-ignore-next-line */
        $events = Redis::xRange(
            self::ALL_EVENTS_KEY,
            $start,
            (int) Carbon::now()->valueOf()
        );
        unset($events[$start]);
        return $events;
    }

    /**
     * 对事件进行解析和处理后返回
     * @return array{type: string, data: array, id: string}
     */
    public function parseEvents(array $eventsFromRedis): array
    {
        return collect($eventsFromRedis)
            ->map(function (array $item, string $id) {
                return array_merge(
                    json_decode($item['event'], true),
                    ['id' => $id]
                );
            })->all();
    }

    // 获取服务名称
    public function getServiceName(): string
    {
        return 'base';
    }
}
