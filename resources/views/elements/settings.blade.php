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
    <small class="fw-bold">COURSE</small>
    <select name="" id="select_course" class="custom-select">
        @foreach ($otherfees as $course => $x)
            <option value="{{ $ctr++ }}">{{ $course }} - Last Updated: {{ $course_lastupdated[$course] }}
            </option>
        @endforeach
    </select>
</div>

<?php
$ctr = 0;
$checkid = 0;
$switchcolor = '';
?>

@foreach ($otherfees as $coursename => $course)
    <div class="course-settings {{ $ctr == 0 ? '' : 'd-none' }}" id="course_{{ $ctr }}">
        <div class="accordion" id="accordion_course_{{ $ctr }}">
            @foreach ($course as $yearlevel => $yr)
                <div class="card">
                    <div class="card-header" id="heading_cs_{{ $ctr }}_{{ $yearlevel }}">
                        <div class="row d-flex justify-content-end align-items-center">
                            <div class="col">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                    data-target="#coll_accordion_cs_{{ $ctr }}_{{ $yearlevel }}"
                                    aria-controls="coll_accordion_cs_{{ $ctr }}_{{ $yearlevel }}">
                                    <strong>{{ strtoupper(ordinal($yearlevel)) }} YEAR</strong>
                                </button>
                            </div>
                            <div class="col-1">
                                <strong id="checked_ctr_{{ $ctr }}_{{ $yearlevel }}"></strong>
                            </div>
                        </div>
                    </div>
                    <div id="coll_accordion_cs_{{ $ctr }}_{{ $yearlevel }}" class="collapse"
                        aria-labelledby="heading_cs_{{ $ctr }}_{{ $yearlevel }}"
                        data-parent="#accordion_course_{{ $ctr }}">
                        <div class="card-body p-3">
                            @foreach ($yr as $semname => $sem)
                                <div class="row my-3 d-flex justify-content-end">
                                    <div class="col"><strong>{{ ordinal($semname) }} Semester</strong></div>
                                    <div class="col-3">
                                        <div class="custom-control custom-switch text-end">
                                            <input type="checkbox" class="custom-control-input toggleall"
                                                id="toggleall_{{ $ctr }}_{{ $yearlevel }}_{{ $semname }}">
                                            <label class="custom-control-label"
                                                for="toggleall_{{ $ctr }}_{{ $yearlevel }}_{{ $semname }}">Toggle
                                                All</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div id="settings_{{ $ctr }}_{{ $yearlevel }}_{{ $semname }}">
                                    <ul class="list-unstyled card-columns">
                                        @foreach ($sem as $typeoffeename => $typeoffee)
                                            <li>
                                                <div class="card p-3">
                                                    <strong>{{ $typeoffeename }}</strong>
                                                    <ul class="list-unstyled">
                                                        @foreach ($typeoffee as $categoryid => $category)
                                                            <li>
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="switch_{{ $checkid }}"
                                                                        value="{{ $category['id'] }}"
                                                                        {{ $category['bs_status'] == 1 ? 'checked' : '' }}>
                                                                    <label class="custom-control-label"
                                                                        for="switch_{{ $checkid++ }}">{{ $category['category'] }}<small
                                                                            class="text-muted"> +
                                                                            {{ $category['amount'] }}</small>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
            <?php $ctr++; ?>
        </div>
    </div>
@endforeach
