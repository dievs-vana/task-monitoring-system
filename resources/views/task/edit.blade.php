<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Create Task</h1>
                    <div class="mb-3">
                        <a href="{{ route('task.index') }}" class="btn btn-danger float-end">Back</a>
                        <br>
                        <br>
                    </div>
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="title">Title:</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            value="{{ $task->title }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="description">Description: </label>
                                        <textarea name="description" id="description" class="form-control">{!! $task->description !!}</textarea>
                                    </div>


                                    <div class="mb-3">
                                        <div class="col">
                                            <label for="file" class="btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-upload">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                    <path d="M7 9l5 -5l5 5" />
                                                    <path d="M12 4l0 12" />
                                                </svg> Upload File
                                            </label>
                                            <input type="file" name="file" id="file" accept="image/pdf"
                                                style="display: none;">
                                        </div>
                                    </div>

                                    {{-- <div class="mb-3">
                                        <label for="status">status</label>
                                        <input type="checkbox" name="status" checked id="status">
                                    </div> --}}

                                    <div class="mb-3">
                                        <label for="status">Status</label>
                                        <br>
                                        <input type="checkbox" name="status" {{ $task->status == 1 ? 'checked' : '' }}
                                            style="width: 30px, height: 30px">
                                        Checked=visible, uncheck=hidden
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
