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
        @foreach ($course as $yearlevel => $yr)
            <?php
            $yearlevel == 1 ? ($switchcolor = 'bg-danger') : '';
            $yearlevel == 2 ? ($switchcolor = 'bg-primary') : '';
            $yearlevel == 3 ? ($switchcolor = 'bg-warning') : '';
            $yearlevel == 4 ? ($switchcolor = 'bg-dark') : '';
            ?>
            <div class="card my-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-auto"><small class="fw-bold">{{ strtoupper(ordinal($yearlevel)) }} YEAR</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    @foreach ($yr as $semname => $sem)
                        <div class="row my-3">
                            <div class="col-auto"><strong>{{ ordinal($semname) }} Semester</strong></div>
                            <div class="col-2">
                                <div class="form-check form-control-lg form-switch text-end">
                                    <input type="checkbox" class="{{ $switchcolor }} form-check-input toggleall"
                                        id="toggleall_{{ $ctr }}">
                                    <label class="form-check-label" for="toggleall_{{ $ctr }}">Toggle
                                        All</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div id="settings_{{ $ctr++ }}">
                            <ul class="list-unstyled card-columns">
                                @foreach ($sem as $typeoffeename => $typeoffee)
                                    <li>
                                        <div class="card p-3">
                                            <strong>{{ $typeoffeename }}</strong>
                                            <ul class="list-unstyled">
                                                @foreach ($typeoffee as $categoryid => $category)
                                                    <li>
                                                        <div class="form-check form-control-lg form-switch">
                                                            <input type="checkbox"
                                                                class="{{ $switchcolor }} form-check-input"
                                                                id="switch_{{ $checkid }}"
                                                                value="{{ $category['id'] }}"
                                                                {{ $category['bs_status'] == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label"
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
        @endforeach
    </div>
@endforeach
