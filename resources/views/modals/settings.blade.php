<?php
function ordinal($number)
{
    $ends = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
    if ($number % 100 >= 11 && $number % 100 <= 13) {
        return $number . 'th';
    } else {
        return $number . $ends[$number % 10];
    }
}
$ctr = 0;
?>
<div class="mb-3">
    <select name="" id="select_course" class="custom-select">
        @foreach ($otherfees as $course => $x)
            <option value="{{ $ctr++ }}">{{ $course }}</option>
        @endforeach
    </select>
</div>

<?php
$ctr = 0;
?>
@foreach ($otherfees as $coursename => $course)
    <div class="course-settings {{ $ctr == 0 ? '' : 'd-none' }}" id="course_{{ $ctr }}">
        <div class="mb-3">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input toggleall" id="toggleall_{{ $ctr }}">
                <label class="custom-control-label" for="toggleall_{{ $ctr }}">Toggle All</label>
            </div>
        </div>
        @foreach ($course as $yearlevel => $yr)
            <div class="card p-3">
                <strong class="mb-3">{{ ordinal($yearlevel) }} Year</strong>
                <div id="settings_{{ $ctr++ }}">
                    <ul class="list-unstyled card-columns">
                        @foreach ($yr as $typeoffeename => $typeoffee)
                            <li>
                                <div class="card p-3">
                                    <strong>{{ $typeoffeename }}</strong>
                                    <ul class="list-unstyled">
                                        @foreach ($typeoffee as $categoryname => $category)
                                            <li>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="switch_{{ $category['id'] }}">
                                                    <label class="custom-control-label"
                                                        for="switch_{{ $category['id'] }}">{{ $category['category'] }}</label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endforeach
