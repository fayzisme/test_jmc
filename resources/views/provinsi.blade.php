<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:!text-gray-200 leading-tight">
            {{ __('Provinsi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div  class="container-fluid" >
                <div class="row">
                  <div class="col">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                          <div><strong>Failed</strong></div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card" >
                        {{-- modal --}}
                        <div class="modal fade" id="modal-default">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Provinsi</h4>
                                <button x-ref="close" id="close_modal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form id="quickFormprovinsi" @submit="$store.dataTable.submitForm($event)">
                              <div class="modal-body">
                                <div class="card">
                                  
                                      @csrf()
                                      <template x-if="$store.dataTable.editStatus">
                                        <input type="hidden" name="_method" value="PUT">
                                      </template>
      
                                      <div class="card-body">
                                        <div class="form-group">
                                          <label for="exampleInputNama1">Nama Provinsi</label>
                                          <input type="text" name="name" class="form-control @error('nama') is-invalid @enderror" id="exampleInputNama1" placeholder="Masukkan Nama" x-model="$store.dataTable.data.name" required>
                                          @error('name')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                        </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" style="color: #007bff;">
                                      <div x-show="$store.dataTable.loading" class="spinner-border" role="status">
                                        <span class="sr-only">Loading...</span>
                                      </div>
                                      Submit
                                    </button>
                                  </div>
                              </div>
                            </form>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                        <div class="card-header">
                          <div class="row">
                            <div class="col-md-6"><h3 class="card-title">Data Table Provinsi</h3></div>
                            
                            <div class="col-md-6">
                              {{-- <a href="{{ route('provinsi.create') }}" type="button" class="btn btn-primary float-right">
                                <i class="fas fa-plus"></i><span> Add provinsi</span>
                              </a> --}}
                              <button type="button" class="btn btn-primary float-right" style="color: #007bff" data-toggle="modal" data-target="#modal-default" @click="$store.dataTable.addData">
                                <i class="fas fa-plus"></i><span> Tambah provinsi</span>
                              </button>
                            </div>
                          </div>
                          
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="datatable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                              <th>No</th>
                              <th>Action</th>
                              <th>Nama Provinsi</th>
                              <th>Tanggal Dibuat</th>
                            </tr>
                            </thead>
                            {{-- <tfoot>
                            <tr>
                              <th>Rendering engine</th>
                              <th>Browser</th>
                              <th>Platform(s)</th>
                              <th>Engine version</th>
                              <th>CSS grade</th>
                            </tr>
                            </tfoot> --}}
                          </table>
                          {{-- <div class="pagination">
                            {{ $provinsis->links() }}
                          </div> --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                  </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
    
    @push('js')
    <script>
        $(".form-control-sm").removeAttr('placeholder')
        setTimeout(() => {
            $(".form-control-sm").attr("placeholder", "Nama Provinsi");
        }, 500);
    </script>
    <script type="text/javascript">
      
      const actionUrl = '{{ route('provinsi.store') }}';
      const url = `{{ url('provinsi') }}`;
      const kabupatenUrl = '';
      const store = '{{ route('provinsi.store') }}';
      const apiUrl = 'api/provinsi/list';
      const columns = [
          {
              'data': 'DT_RowIndex',
              'class': 'text-center',
              'width' : '50px',
              'orderable': true
          },
          {
              render: (index, row, data, meta) => {
                return `
                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Edit">
                    <a href="#" type="button" onclick=methods.editData(event,${data.id}) class="btn btn-outline-warning" data-toggle="modal" data-target="#modal-default">
                      <i class="fas fa-pen"></i>
                    </a>
                </span>
                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Delete">
                    <a href="#" type="button" onclick=methods.deleteData(event,${data.id}) class="btn btn-outline-danger">
                      <i class="fas fa-trash"></i>
                    </a>
                </span>`
              },
              'width': '150px',
              'orderable': false
          },
          {
              'data': 'name',
              'class': 'text-center',
              
              'orderable': true
          },
          {
              'data': 'created_at',
              'class': 'text-center',
              'width': '180px',
              'orderable': true
          },
          
      ];
      
    </script>
        
    @endpush
</x-app-layout>

