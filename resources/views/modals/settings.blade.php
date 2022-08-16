@foreach ($otherfees as $coursename => $course)
    <div id="{{ $coursename }}" class="">
        <strong>{{ $coursename }}</strong>
        <ul class="list-unstyled card-columns">
            @foreach ($course as $typeoffeename => $typeoffee)
                <li>
                    <div class="card p-1">
                        <strong>{{ $typeoffeename }}</strong>
                        <ul>
                            @foreach ($typeoffee as $categoryname => $category)
                                <li>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="switch_{{ $category }}"
                                            checked>
                                        <label class="custom-control-label"
                                            for="switch_{{ $category }}">{{ $category }}</label>
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
