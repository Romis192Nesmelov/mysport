<div class="owl-carousel calendar">
    @php $week = 1; @endphp
    @for($month=1;$month <= (date('n') > 10 ? 12 + date('n') - 8 : 12);$month++)
        @php
            if ($month > 12) {
                $month = $month - 12;
                $year = $year + 1;
            }
        @endphp
        <div class="calendar-block">
            @php
                // Calculate how many weeks in month
                $weeksOnMonth = 1;
                for($d=1;$d<=Helper::getNumberDaysInMonth($month, $year);$d++) {
                    if ($d > 1 && date('N', strtotime($month.'/'.$d.'/'.$year)) == 1) $weeksOnMonth++;
                }
            @endphp

            <div class="month">{{ trans('calendar.m'.$month).' '.$year }}</div>
            <table>
                <tr class="week">
                    @for($wd=0;$wd<=7;$wd++)
                        <td>{{ $wd ? trans('calendar.d'.$wd) : '' }}</td>
                    @endfor
                </tr>
                @php $day = 0; @endphp
                @for($w=1;$w<=$weeksOnMonth;$w++)
                    <tr>
                        @for($wd=0;$wd<=7;$wd++)
                            @if(!$wd)
                                <td><i>{{ $week }}</i></td>
                            @else
                                @php
                                    if ($w == 1 && $wd == date('N', strtotime($month.'/1/'.$year))) $day = 1;
                                    $dayData = Helper::addZero($day).'.'.Helper::addZero($month).'.'.$year;
                                @endphp
                                <td class="{{ isset($inputName) && $inputName ? 'pickering' : '' }} {{ isset($inputName) && $dayData == $value ? 'chosen' : '' }}" data="{{ $dayData }}">
                                    @if ($day && $day <= Helper::getNumberDaysInMonth($month, $year))
                                        @php
                                            $eventsMatch = false;
                                            if (isset($events) && count($events)) {
                                                foreach ($events as $event) {
                                                    if (
                                                        date('Y',$event->start_time) == $year &&
                                                        date('n',$event->start_time) == $month &&
                                                        date('j',Helper::setMoscowTimeZone($event->start_time)) == $day
                                                        ) {
                                                            $eventsMatch = $event;
                                                            break;
                                                    }
                                                }
                                            }
                                            $incrementWeek = true;
                                        @endphp

                                        @if ($eventsMatch)
                                            <div class="event-day">
                                                @if (!isset($inputName) || !$inputName)
                                                    <a href="{{ url('/events/'.$eventsMatch->slug) }}">{{ $day }}</a>
                                                @else
                                                    {{ $day }}
                                                @endif
                                            </div>
                                        @else
                                            {{ $day }}
                                        @endif

                                    @else
                                        @php $incrementWeek = false; @endphp
                                    @endif
                                </td>
                            @endif
                            @php if ($day && $wd) $day++; @endphp
                        @endfor
                    </tr>
                    @php if ($incrementWeek) $week++; @endphp
                @endfor
            </table>
        </div>
    @endfor
</div>

@if (isset($inputName) && $inputName)
    @if (count($errors) && $errors->has($inputName))
        <div class="help-block error error-{{ $inputName }}">{!! $errors->first($inputName) !!}</div>
    @endif

    <input type="hidden" name="{{ $inputName }}" value="{{ $value }}">
    <script>
        window.currentMonth = parseInt("{{ $value }}".split('.')[1])-1;
        $('td.pickering').click(function () {
            var self = $(this),
                chosen = $('td.chosen'),
                chosenDay = chosen.find('.event-day').html(),
                eventDay = self.find('.event-day');

            chosen.removeClass('chosen');
            self.addClass('chosen');

            if (!eventDay.length) {
                var day = self.html();
                self.html('<div class="event-day new">'+day+'</div>');
            }

            if (chosen.find('.event-day.new').length) chosen.html(chosenDay);

            $("input[name={{ $inputName }}]").val(self.attr('data'));
        });
    </script>
@else
    <script>window.currentMonth = parseInt("{{ date('n') }}")-1;</script>
@endif