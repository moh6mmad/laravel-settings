<x-app-layout>
    @can('role-list')
    <x-page-header>
        {{ __('Settings') }}
        <x-slot name="buttons">
            <a href="{{route('settings')}}" class="btn btn-primary d-none d-sm-inline-block">
                &larr; Settings</a>
        </x-slot>
    </x-page-header>
    <x-page-body>
<div class="card">
    <div class="card-header">New Setting</div>
    <div class="card-body">
        <form action="{{route('settings.new')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="">Select type</label>
                    {!!
                    Form::select(
                    "input_type",
                    [
                    'text' => 'Text',
                    'textarea' => 'Textarea',
                    'number' => 'Number',
                    'select' => 'Select',
                    ],
                    '',
                    [
                    'class' => "form-control mb-4"
                    ]
                    )
                    !!}
                </div>
                <div class="col-md-4">
                    <label for="">Name</label>
                    <input type="text" name="name" required="" class="mb-4 form-control" id="">
                </div>
                <div class="col-md-4">
                    <label for="">Group</label>
                    <input type="text" required="" name="setting_group" class="mb-4 form-control" id="">
                </div>
                <div class="col-md-6">
                    <label for="">Value</label>
                    <textarea name="value" id="" class="mb-4 form-control" id=""></textarea>
                </div>
                <div class="col-md-6">
                    <label for="">Options</label>
                    <textarea name="options" id="" class="mb-4 form-control" id=""></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-plus"></i> Create new setting</button>
        </form>
    </div>
</div>
@endcan
    </x-page-body>
</x-app-layout>