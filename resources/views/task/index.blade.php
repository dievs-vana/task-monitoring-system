<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session()->has('status'))
                <div class="alert alert-success">
                    {{ session()->get('status') }}
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Tasks List</h1>
                    <div class="mb-3">
                        <a href="{{ route('task.create') }}" class="btn btn-primary float-end">Add Task</a>
                        <br>
                        <br>
                    </div>
                    <div class="container">

                        <div class="card">
                            <div class="card-body">
                                <div class="container text-center">
                                    <div class="row align-items-start">
                                        <div class="col">
                                            <div class="card" style="width: 18rem;">
                                                <h1>Pending</h1>
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Title</th>
                                                            <th>Description</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($tasks as $task)
                                                            <tr>

                                                                <td draggable="true">{{ $task->title }} </td>
                                                                <td draggable="true">{{ $task->description }} </td>
                                                                <td draggable="true">{{ $task->status }} </td>
                                                                <td>
                                                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                                                        class="btn btn-success">Edit</a>

                                                                    <form
                                                                        action="{{ route('tasks.destroy', $task->id) }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="card" style="width: 18rem;">
                                                <h1>On-Going</h1>

                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Title</th>
                                                            <th>Description</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="card" style="width: 18rem;">
                                                <h1>Done</h1>
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Title</th>
                                                            <th>Description</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                {{-- Pagination --}}
                                <div class="d-flex justify-content-center">
                                    {{ $tasks->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
{{-- <template>
    <div class="row">
        <div class="col-3">
            <h3>Draggable 1</h3>
            <draggable class="list-group" :list="list1" group="people" @change="log">
                <div class="list-group-item" v-for="(element, index) in list1" :key="element.name">
                    {{ element . name }} {{ index }}
                </div>
            </draggable>
        </div>

        <div class="col-3">
            <h3>Draggable 2</h3>
            <draggable class="list-group" :list="list2" group="people" @change="log">
                <div class="list-group-item" v-for="(element, index) in list2" :key="element.name">
                    {{ element . name }} {{ index }}
                </div>
            </draggable>
        </div>

        <rawDisplayer class="col-3" :value="list1" title="List 1" />

        <rawDisplayer class="col-3" :value="list2" title="List 2" />
    </div>
</template>

<script>
    import draggable from "@/vuedraggable";

    export default {
        name: "two-lists",
        display: "Two Lists",
        order: 1,
        components: {
            draggable
        },
        data() {
            return {
                list1: [{
                        name: "John",
                        id: 1
                    },
                    {
                        name: "Joao",
                        id: 2
                    },
                    {
                        name: "Jean",
                        id: 3
                    },
                    {
                        name: "Gerard",
                        id: 4
                    }
                ],
                list2: [{
                        name: "Juan",
                        id: 5
                    },
                    {
                        name: "Edgard",
                        id: 6
                    },
                    {
                        name: "Johnson",
                        id: 7
                    }
                ]
            };
        },
        methods: {
            add: function() {
                this.list.push({
                    name: "Juan"
                });
            },
            replace: function() {
                this.list = [{
                    name: "Edgard"
                }];
            },
            clone: function(el) {
                return {
                    name: el.name + " cloned"
                };
            },
            log: function(evt) {
                window.console.log(evt);
            }
        }
    };
</script> --}}
