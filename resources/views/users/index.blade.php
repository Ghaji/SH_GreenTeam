<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        SN
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Username
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fullname
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Phone Number
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Manage
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>

                                    </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php $sn = 1; ?>
                                    @foreach ($users as $user)
                                    <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $sn }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            {{ $user->username }}
                                        </div>

                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->lastname }} {{ $user->firstname }}</div>
                                        {{-- <div class="text-sm text-gray-500">Optimization</div> --}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $user->email }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->phone_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a> |
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900 delete" data-id="{{ $user->id }}">Delete</a>
                                    </td>
                                    </tr>
                                    <?php $sn++ ?>
                                @endforeach

                                    <!-- More people... -->
                                </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-id">
            <div class="relative w-auto my-6 mx-auto max-w-3xl">
              <!--content-->
              <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                <!--header-->
                <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">

                  <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-id')">
                    <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                      ×
                    </span>
                  </button>
                </div>
                <!--body-->
                <div class="relative p-6 flex-auto">
                  <form action="" method="POST">
                      @csrf
                      <input type="hidden" name="user_id" id="user_id" value="">
                    <p class="my-4 text-blueGray-500 text-lg leading-relaxed">
                        are you sure you want to delete this record?
                      </p>
                  </form>
                </div>
                <!--footer-->
                <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
                  <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" id="close">
                    No
                  </button>
                  <button class="bg-emerald-500 active:bg-emerald-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" id="delete_user">
                    Yes
                  </button>
                </div>
              </div>
            </div>
          </div>


</x-app-layout>

{{-- <script>
    $(document).on('click', '.delete-modal', function() {
      $('.modal-title').text('Delete');
      $('#id_delete').val($(this).data('id'));
      id = $('#id_delete').val();
      $('#deleteModal').modal('show');
  });
</script> --}}

<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>

        <script>
            $(document).on('click', '.delete', function(){

                var id = $(this).data('id')

                $('#user_id').val(id)

                $('#modal-id').show()
            })


            $(document).on('click', '#close', function(){
                $('#modal-id').hide()
            })

    $(document).on('click', '#delete_user', function(e) {
        var id = $("#user_id").val()
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'DELETE',
            url: 'users/' + id,
            data: {
                // '_token': $('input[name=_token]').val(),
                'id': id
            },
            success: function(data) {
                window.location.reload();
                }
            });
        });
    </script>

