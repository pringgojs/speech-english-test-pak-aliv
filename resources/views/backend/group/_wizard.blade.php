<div class="wizard">
    <div class="steps clearfix">
        <ul role="tablist">
            <li role="tab" class="first @if($from == 'step-1') current @endif @if($group->id) done @endif" aria-disabled="false" aria-selected="true">
                <a href="#" aria-controls="example-basic-p-0">
                    <span class="current-info audible">current step: </span><span class="number">1</span> <span class="head-font capitalize-font">Create Group</span>
                </a>
            </li>
            <li role="tab" class=" @if($from == 'step-2') current @endif @if($group->student) done @else disabled @endif" aria-disabled="false" aria-selected="false">
                <a href="#" aria-controls="example-basic-p-1">
                    <span class="number">2</span> <span class="head-font capitalize-font">Select Student</span>
                </a>
            </li>
            <li role="tab" class="last disabled" aria-disabled="false" aria-selected="false">
                <a href="#" aria-controls="example-basic-p-2">
                    <span class="number">3</span> <span class="head-font capitalize-font">Select Topic</span>
                </a>
            </li>
        </ul>
    </div>
</div>