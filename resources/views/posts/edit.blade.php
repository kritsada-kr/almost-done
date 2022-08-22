@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <h1 class="text-3xl mb-6">
            Edit post
        </h1>

        <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="relative z-0 mb-6 w-full group">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Post Title
                </label>
                @if ($errors->has('title'))
                    <p class="text-red-500">
                        {{ $errors->first('title') }}
                    </p>
                @endif
                <input type="text" name="title" id="title"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ old('title', $post->title) }}"
                       placeholder="" required>
            </div>

            <div class="container">
                <label class="form-label text-green-400" style="font-weight: bold;" for="tags">Tags</label>
                <select class="form-input" style="color: #41A7A5" aria-label="Default select example" id="tags" name="tags" required >
                    <option selected disabled hidden value="">-------Select Tags-------</option>
                    @foreach (\App\Models\Tag::all() as $tag)
                        <option value="{{$tag->id}}" id="tags" name="tags" >{{$tag->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="container">
                <label class="form-label text-green-400" style="font-weight: bold;" for="organizations">Tags</label>
                <select class="form-input" style="color: #41A7A5" aria-label="Default select example" id="organizations" name="organizations" required >
                    <option selected disabled hidden value="">-------Select Tags-------</option>
                    @foreach (\App\Models\OrganizationTag::all() as $organizationTag)
                        <option value="{{$organizationTag->id}}" id="tags" name="tags" >{{$organizationTag->name}}</option>
                    @endforeach
                </select>
            </div>
                @can('updateStatus',$post)
                <div class="container">
                    <label class="form-label text-green-400" style="font-weight: bold;" for="progression">Tags</label>
                    <select class="form-input" style="color: #41A7A5" aria-label="Default select example" id="progression" name="progression" required >
                        <option selected disabled hidden value="">-------Select Tags-------</option>
                        <option value="ยื่นคำร้อง/ปัญหา" id="progression" name="progression" >ยื่นคำร้อง/ปัญหา</option>
                        <option value="รับคำร้อง/ปัญหา" id="progression" name="progression" >รับคำร้อง/ปัญหา</option>
                        <option value="กำลังดำเนินการ" id="progression" name="progression" >กำลังดำเนินการ</option>
                        <option value="เสร็จสมบูรณ์" id="progression" name="progression" >เสร็จสมบูรณ์</option>
                    </select>
                </div>
                @endcan

            <div class="relative z-0 mb-6 w-full group">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                    Post Description
                </label>
                @if ($errors->has('description'))
                    <p class="text-red-500">
                        {{ $errors->first('description') }}
                    </p>
                @endif
                <textarea rows="4" type="text" name="description" id="description"
                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          required >{{ old('description', $post->description) }}</textarea>
            </div>

            <div >
                <label>Choose Images</label>
                <input type="file" id="browse" name="images[]" multiple>
            </div>




            <div>
                <button class="app-button" type="submit">Edit</button>
            </div>

        </form>
    </section>

    <section class="mx-8 mt-16">
                    <h3 class="text-red-600 mb-4 text-2xl">
                        Delete Images
                        <p class="text-gray-800 text-xl">
                            Once you delete images, there is no going back. Please be certain.
                        </p>
                    </h3>



                    <form action="{{ route('posts.images.deleteImage',['post' => $post->id]) }}" method="post">
                        @csrf
                        <div class="container">
                            <label class="form-label text-green-400" style="font-weight: bold;" for="imageNames">Tags</label>
                            <select class="form-input" style="color: #41A7A5" aria-label="Default select example" id="imageNames" name="imageNames" required >
                                <option selected disabled hidden value="">-------Select Image-------</option>
                                @foreach($post->images as $image)
                                    <option value="{{$image->title}}" id="imageNames" name="imageNames" >{{$image->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button class="app-button red" type="submit">DELETE IMAGE</button>
                        </div>
                    </form>

                    <form action="{{ route('posts.images.deleteAll',['post' => $post->id]) }}" method="post">
                        @csrf
                        <div>
                            <button class="app-button red" type="submit">DELETE ALL IMAGES</button>
                        </div>
                    </form>


    </section>



    @can('delete', $post)
        <section class="mx-8 mt-16">
            <div class="relative py-4">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-b border-red-300"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-white px-4 text-sm text-red-500">Danger Zone</span>
                </div>
            </div>




                <h3 class="text-red-600 mb-4 text-2xl">
                    Delete this Post
                    <p class="text-gray-800 text-xl">
                        Once you delete a post, there is no going back. Please be certain.
                    </p>
                </h3>

                <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="relative z-0 mb-6 w-full group">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Post Title to Delete
                        </label>
                        <input type="text" name="title" id="title"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="" required>
                    </div>
                    <button class="app-button red" type="submit">DELETE</button>
                </form>
            </div>
        </section>
    @endcan

@endsection
