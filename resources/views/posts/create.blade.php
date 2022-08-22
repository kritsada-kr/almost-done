@extends('layouts.main')


@section('content')
    <section class="mx-8">
        <div class="shadow-lg rounded-lg overflow-hidden m-5 border-2">
            <div class="p-5">
            <h1 class="text-3xl mb-6 font-bold">
                ส่งคำร้องเรียน
            </h1>


            <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">

                @csrf

                <div class="relative z-0 mb-6 w-full group">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 font-bold">
                        Title:
                    </label>
                    @if ($errors->has('title'))
                        <p class="text-red-500">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                    <input type="text" name="title" id="title"
                        class="bg-gray-50 border @if($errors->has('title')) border-red-300 @else border-gray-300 @endif text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ old('title') }}"
                        placeholder="" required>
                </div>


                <div class="container">
                    <label class="form-label text-black" style="font-weight: bold;" for="tags">หมวดหมู่ : </label>
                    <select class="form-input"  aria-label="Default select example" id="tags" name="tags" required >
                        <option selected disabled hidden value="">-------Select Tags-------</option>
                        @foreach (\App\Models\Tag::all() as $tag)
                                <option value="{{$tag->id}}" id="tags" name="tags" >{{$tag->name}}</option>
                        @endforeach
                    </select>

                    <label class="form-label text-black" style="font-weight: bold;" for="organizations">องค์กร : </label>
                    <select class="form-input"  aria-label="Default select example" id="organizations" name="organizations" required >
                        <option selected disabled hidden value="">-------Select Tags-------</option>
                        @foreach (\App\Models\OrganizationTag::all() as $organizationTag)
                            <option value="{{$organizationTag->id}}" id="tags" name="tags" >{{$organizationTag->name}}</option>
                        @endforeach
                    </select>
                </div>

                <br/>

                <div class="relative z-0 mb-6 w-full group">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 font-bold">
                        Description :
                    </label>
                    @if($errors->has('description'))
                        <p class="text-red-500">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                    <textarea rows="4" type="text" name="description" id="description"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required >{{ old('description') }}</textarea>
                </div>

                <div >
                    <label>Choose Images : </label>
                    <input type="file" id="browse" name="images[]" multiple required>
                </div>

                @error('images.*')
                <div class="alert alert-danger ">invalid file type</div>
                @enderror

                <div class="mx-3 my-4">
                    <input type="checkbox" name="status">
                    <label>Post as anonymous</label>
                </div>







                <div>
                    <button class="flex justify-end app-button-orange" type="submit"  >Create</button>
                </div>




            </form>
            </div>
            
        </div>
        
    </section>

@endsection
