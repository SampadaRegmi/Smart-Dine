@extends('Admin.Layouts.Master')
@section('main-content')
    <div class="row">
        <div class="col-12">
            <h1> Update Menu</h1>
            <div class="card">
                <div class="card-header">{{ __('Update Menu') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('menu.update', $menu->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ $menu->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description"
                                class="col-md-4 col-form-label text-md-end">{{ __('description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="description"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    value="{{ $menu->description }}" required autocomplete="description">

                                @error('description')
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
                                    name="keywords" value="{{ old('keywords', $menu->keywords) }}" required autocomplete="keywords">
                                
                                @error('keywords')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Status Field -->
                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>
                            
                            <div class="col-md-6">
                                <input id="status" type="number" class="form-control @error('status') is-invalid @enderror"
                                    name="status" value="{{ old('status', $menu->status) }}" required>
                                
                                @error('status')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Popular Field -->
                        <div class="row mb-3">
                            <label for="popular" class="col-md-4 col-form-label text-md-end">{{ __('Popular') }}</label>
                            
                            <div class="col-md-6">
                                <input id="popular" type="number" class="form-control @error('popular') is-invalid @enderror"
                                    name="popular" value="{{ old('popular', $menu->popular) }}" required>
                                
                                @error('popular')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image"
                                class="col-md-4 col-form-label text-md-end">{{ __('Profile Image') }}</label>

                            <div class="col-md-6">
                                <img src="{{ asset($menu->image) }}" alt="" height="100px" width="auto">
                                <input id="image" type="file"
                                    class="form-control @error('image') is-invalid @enderror" name="image" value="">

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
                                    autocomplete="new-price">

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
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
