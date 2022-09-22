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
<div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Collapsible Group Item #1
          </button>
        </h2>
      </div>
  
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          Some placeholder content for the first accordion panel. This panel is shown by default, thanks to the <code>.show</code> class.
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingTwo">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Collapsible Group Item #2
          </button>
        </h2>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
          Some placeholder content for the second accordion panel. This panel is hidden by default.
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingThree">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Collapsible Group Item #3
          </button>
        </h2>
      </div>
      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
        <div class="card-body">
          And lastly, the placeholder content for the third and final accordion panel. This panel is hidden by default.
        </div>
      </div>
    </div>
  </div>
@foreach ($otherfees as $coursename => $course)
    <div class="course-settings {{ $ctr == 0 ? '' : 'd-none' }}" id="course_{{ $ctr }}">
        @foreach ($course as $yearlevel => $yr)
            <?php
            $yearlevel == 1 ? ($switchcolor = 'bg-danger') : '';
            $yearlevel == 2 ? ($switchcolor = 'bg-primary') : '';
            $yearlevel == 3 ? ($switchcolor = 'bg-warning') : '';
            $yearlevel == 4 ? ($switchcolor = 'bg-dark') : '';
            ?>
            <div class="accordion" id="accordion_{{ $yearlevel }}">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_{{ $yearlevel }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#coll_accordion_{{ $yearlevel }}" aria-expanded="true"
                            aria-controls="coll_accordion_{{ $yearlevel }}"><strong>{{ strtoupper(ordinal($yearlevel)) }}
                                YEAR</strong>
                        </button>
                    </h2>
                    <div id="coll_accordion_{{ $yearlevel }}" class="accordion-collapse collapse show"
                        aria-labelledby="heading_{{ $yearlevel }}" data-bs-parent="#accordion_{{ $yearlevel }}">
                        <div class="accordion-body p-3">
                            @foreach ($yr as $semname => $sem)
                                <div class="row my-3 d-flex justify-content-end">
                                    <div class="col"><strong>{{ ordinal($semname) }} Semester</strong></div>
                                    <div class="col-2">
                                        <div class="custom-control custom-switch text-end">
                                            <input type="checkbox"
                                                class="{{ $switchcolor }} custom-control-input toggleall"
                                                id="toggleall_{{ $ctr }}">
                                            <label class="custom-control-label"
                                                for="toggleall_{{ $ctr }}">Toggle
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
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox"
                                                                        class="{{ $switchcolor }} custom-control-input"
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
            </div>
        @endforeach
    </div>
@endforeach
