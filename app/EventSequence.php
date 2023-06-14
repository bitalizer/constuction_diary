<?php

namespace EBuildingDiary;

use Illuminate\Database\Eloquent\Model;

/**
 * EBuildingDiary\EventSequence
 *
 * @property-read \EBuildingDiary\Event $event
 * @mixin \Eloquent
 * @property int $id
 * @property int $event_id
 * @property string $start_datetime
 * @property string $end_datetime
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\EventSequence whereEndDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\EventSequence whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\EventSequence whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\EventSequence whereStartDatetime($value)
 */
class EventSequence extends Model
{
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
