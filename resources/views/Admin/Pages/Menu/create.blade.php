@extends('Admin.Layouts.Master')
@section('main-content')
    <div class="row">
        <div class="col-12">
            <h1>Create Menu</h1>
            <div class="card">
                <div class="card-header">{{ __('Create Menu') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('menu.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Keywords Field -->
                        <div class="row mb-3">
                            <label for="keywords" class="col-md-4 col-form-label text-md-end">{{ __('Keywords') }}</label>

                            <div class="col-md-6">
                                <input id="keywords" type="text" class="form-control @error('keywords') is-invalid @enderror"
                                    name="keywords" value="{{ old('keywords') }}" required autocomplete="keywords">

                                @error('keywords')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description"
                                class="col-md-4 col-form-label text-md-end">{{ __('Menu Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    value="{{ old('description') }}" required autocomplete="description">

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="image"
                                class="col-md-4 col-form-label text-md-end">{{ __('Menu Image') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file"
                                    class="form-control @error('image') is-invalid @enderror" name="image"
                                    value="{{ old('image') }}">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text"
                                    class="form-control @error('price') is-invalid @enderror" name="price"
                                    value="{{ old('price') }}" required autocomplete="price" autofocus>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="FoodCategory" class="col-md-4 col-form-label text-md-end">{{ __('Food Category') }}</label>
                            <div class="col-md-6">
                                <select id="FoodCategory" class="form-control @error('FoodCategory') is-invalid @enderror" name="FoodCategory" required autocomplete="FoodCategory" autofocus>
                                    <option value="">Select Food Category</option>
                                    @foreach(\App\Models\Menu::FoodCategory as $FoodCategory)
                                        <option value="{{ $FoodCategory }}" @if(old('FoodCategory') == $FoodCategory) selected @endif>{{ $FoodCategory }}</option>
                                    @endforeach
                                </select>
                                @error('FoodCategory')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="CourseCategory" class="col-md-4 col-form-label text-md-end">{{ __('Course Category') }}</label>
                            <div class="col-md-6">
                                <select id="CourseCategory" class="form-control @error('CourseCategory') is-invalid @enderror" name="CourseCategory" required autocomplete="CourseCategory" autofocus>
                                    <option value="">Select Course Category</option>
                                    @foreach(\App\Models\Menu::CourseCategory as $CourseCategory)
                                        <option value="{{ $CourseCategory }}" @if(old('CourseCategory') == $CourseCategory) selected @endif>{{ $CourseCategory }}</option>
                                    @endforeach
                                </select>
                                @error('CourseCategory')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('CreateMenu') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
