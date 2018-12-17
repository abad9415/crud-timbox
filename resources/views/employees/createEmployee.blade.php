@extends('layouts.app')

@section('css')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
@endsection

@section('activeCreateEmployees') {{ isset($employee) ? : 'active'}} @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card {{ isset($employee) ? 'border-danger' : 'border-success' }}">
                    <div class="card-header text-white {{ isset($employee) ? 'bg-danger' : 'bg-success' }}">{{ isset($employee) ? strtoupper(__('employees.update employee')) : strtoupper(__('employees.create employee')) }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ isset($employee) ? route('updateEmployeePost') : route('createEmployeePost') }}">
                            @csrf
                            @isset($employee)
                                <input type="hidden" name="id" value="{{ $employee->id }}">
                            @endisset
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="employeeKey">{{ __('employees.employeeKey') }}</label>
                                    <input id="employeeKey" name="employeeKey" type="number" class="form-control {{ $errors->has('employeeKey') ? ' is-invalid' : '' }}"
                                           value="{{ isset($employee->employeeKey) ? $employee->employeeKey : old('employeeKey') }}"
                                           placeholder="Ingrese la clave única de empleado"
                                           {{ isset($employee) ? 'disabled' : '' }}
                                    >
                                    @if ($errors->has('employeeKey'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('employeeKey') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">{{ __('employees.name') }}</label>
                                    <input id="name" name="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           value="{{ isset($employee->name) ? $employee->name : old('name') }}"
                                           placeholder="Ingrese nombre del empleado">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="age">{{ __('employees.age') }}</label>
                                    <input id="age" name="age" type="number" class="form-control {{ $errors->has('age') ? ' is-invalid' : '' }}"
                                           value="{{ isset($employee->age) ? $employee->age : old('age') }}"
                                           placeholder="Ingrese edad del empleado">
                                    @if ($errors->has('age'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="position">{{ __('employees.position') }}</label>
                                    <input id="position" name="position" type="text" class="form-control {{ $errors->has('position') ? ' is-invalid' : '' }}"
                                           value="{{ isset($employee->position) ? $employee->position : old('position') }}"
                                           placeholder="Ingrese el puesto del empleado">
                                    @if ($errors->has('position'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">{{ __('employees.address') }}</label>
                                <input id="address" name="address" type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                       value="{{ isset($employee->address) ? $employee->address : old('address') }}"
                                       placeholder="Ingrese la dirección del empleado">
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="skills">{{ __('employees.skills') }}</label>
                                <select id="skills" name="skills[]" class="selectpicker form-control {{ $errors->has('skills') ? ' is-invalid' : '' }}" multiple>
                                    @foreach($skills as $skill)
                                        <option value="{{ $skill['name'] }}" {{ $skill['selected'] ? 'selected' : ''}}>{{ $skill['name'] }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('skills'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('skills') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn {{ isset($employee) ? 'btn-danger' : 'btn-success' }}">{{ isset($employee) ? 'Modificar' : 'Guardar' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/i18n/defaults-es_ES.js"></script>
@endsection
