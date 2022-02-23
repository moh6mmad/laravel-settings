<x-app-layout>
    @can('role-list')
    <x-page-header>
        {{ __('Settings') }}
        <x-slot name="buttons">
            <a href="{{route('settings.create')}}" class="btn btn-primary d-none d-sm-inline-block">
                Create Setting</a>
        </x-slot>
    </x-page-header>
    <x-page-body>
        <form action="" method="post">
            @csrf



            <ul class="nav nav-tabs" data-bs-toggle="tabs">

                @foreach ($groups as $group)
                <li class="nav-item"><a class="text-capitalize nav-link" 
                        href="#{{$group->setting_group}}"  data-bs-toggle="tab">
                        {{$group->setting_group}}
                    </a></li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach ($groups as $group)
                <div class="tab-pane fade show" id="{{$group->setting_group}}" role="tabpanel">
                    <div class="bg-white p-4">
                        @foreach ($settings as $setting)
                        @if($setting->setting_group == $group->setting_group)

                        <label class="d-block" for="{{$setting->name}}">
                            {{__('settings.'.$setting->name)}}
                            <a onclick="return confirm('Are you sure to delete this setting? It might affect your system behavior.')"
                                href="{{route('settings.delete', ['settingId' => $setting->id])}}"
                                class="float-right text-danger text-sm"><i
                                    class="fa fa-trash"></i></a>
                        </label>

                        <div class="row">
                            <div class="col-md-8">
                                @php
                                $inputType = $setting->input_type;
                                @endphp
                                @if($inputType !== 'select')
                                {!!
                                Form::$inputType(
                                'settings['.$setting->setting_group.']['.$setting->name.']',
                                $setting->value,
                                [
                                'class' => "form-control mb-3"
                                ],
                                !empty($setting->options) && json_decode($setting->options, true) ?
                                json_decode($setting->options, true) : '',
                                )
                                !!}
                                @else

                                @if(!empty($setting->options))
                                @php
                                $options = json_decode($setting->options, true);

                                if (! is_array($options)) {
                                $options = [];
                                }
                                @endphp
                                @endif


                                {!!
                                Form::select(
                                'settings['.$setting->setting_group.']['.$setting->name.']',
                                $options ?? [],
                                $setting->value,
                                [
                                'class' => "form-control mb-3"
                                ],

                                )
                                !!}
                                @endif

                            </div>
                            <div class="col-md-4">
                                {!!
                                Form::select(
                                "types[$setting->name]",
                                [
                                'text' => 'Text',
                                'textarea' => 'Textarea',
                                'number' => 'Number',
                                'select' => 'Select',
                                ],
                                $setting->input_type,
                                [
                                'class' => "form-control mb-3"
                                ]
                                )
                                !!}
                            </div>
                            @if ($setting->input_type === 'select')
                            <div class="col-md-12">
                                {!!
                                Form::textarea(
                                "options[$setting->name]",
                                $setting->options,
                                [
                                'class' => "form-control mb-3",
                                'placeholder' => "Enter selectable options here only as JSON value",
                                'rows' => "3",
                                ]
                                )
                                !!}
                            </div>
                            @endif
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endforeach

            </div>
            <button class="btn btn-primary mt-2" type="submit">Save Settings</button>

        </form>
        @endcan
    </x-page-body>
</x-app-layout>