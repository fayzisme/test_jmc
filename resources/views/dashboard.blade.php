<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:!text-gray-200 leading-tight">
          {{ __('Penduduk') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container-fluid" >
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
              <div class="row">
                <div class="col-lg-4 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3 x-text="$store.dataTable.total_provinsi"></h3>
    
                      <p>Total Provinsi</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-book"></i>
                    </div>
                    <a href="{{ route('provinsi.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3 x-text="$store.dataTable.total_kabupaten"></h3>
      
                      <p>Total Kabupaten</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-book"></i>
                    </div>
                    <a href="{{ route('kabupaten.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3 x-text="$store.dataTable.total_penduduk"></h3>
                      <p>Total Penduduk</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-book"></i>
                    </div>
                    <a href="{{ route('penduduk.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
              </div>
              <div class="card" >
                  {{-- modal --}}
                  <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Penduduk</h4>
                          <button x-ref="close" id="close_modal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form id="quickFormpenduduk" @submit="$store.dataTable.submitForm($event)">
                        <div class="modal-body">
                          <div class="card">
                            
                                @csrf()
                                <template x-if="$store.dataTable.editStatus">
                                  <input type="hidden" name="_method" value="PUT">
                                </template>

                                <div class="card-body">
                                  <div class="form-group">
                                    <label for="exampleInputNama1">Nama Penduduk</label>
                                    <input type="text" name="name" class="form-control @error('nama') is-invalid @enderror" id="exampleInputNama1" placeholder="Masukkan Nama" x-model="$store.dataTable.data.name" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputnik1">NIK</label>
                                    <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="exampleInputnik1" placeholder="Masukkan NIK" x-model="$store.dataTable.data.nik" required>
                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputphone_number1">Phone Number</label>
                                    <input type="number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" id="exampleInputphone_number1" placeholder="Masukkan Phone Number" x-model="$store.dataTable.data.phone_number" required>
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputaddress1">Address</label>
                                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="exampleInputaddress1" placeholder="Enter address" x-model="$store.dataTable.data.address" required>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select id="gender" name="gender" x-model="$store.dataTable.data.gender" class="form-select" aria-label=".form-select example" style="display: block; width:100%;" required>
                                      <option value="">Pilih Satu</option>
                                      <option value="L">Laki - Laki</option>
                                      <option value="P">Perempuan</option>
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                      <div class="input-group date" id="reservationdate">
                                          <input type="date" name="tgl_lahir"  x-model="$store.dataTable.data.tgl_lahir" class="form-control" placeholder="dd/mm/yyyy" required/>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="provinsi">Provinsi</label>
                                      <select id="provinsi" name="provinsi_id" x-model="$store.dataTable.data.provinsi_id" @change="$store.dataTable.changeFilterForm($store.dataTable.data.provinsi_id)" class="form-select" aria-label=".form-select example" style="display: block; width: 100%;" required>
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinsis as $provinsi)
                                        <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                                        @endforeach
                                      </select>
                                      @error('provinsi_id')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                    </div>
                                    <div class="form-group">
                                      <label for="kabupaten">Kabupaten</label>
                                      <select id="kabupaten" name="kabupaten_id" x-model="$store.dataTable.data.kabupaten_id" class="form-select" aria-label=".form-select example" style="display: block; width: 100%;" x-bind:disabled="!$store.dataTable.data.provinsi_id" required>
                                        <option value="">Pilih Kabupaten</option>
                                        <template x-for="kabupaten in $store.dataTable.kabupatensForm">
                                          <option x-bind:value="kabupaten.id" x-text="kabupaten.name"></option>
                                        </template>
                                      </select>
                                      @error('kabupaten_id')
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
                    <div class="row" style="padding-top: 20px;">
                      <div class="col-md-6"><h3 class="card-title">Data Table Penduduk</h3></div>
                      
                      <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <select x-model="$store.dataTable.provinsi" @change="$store.dataTable.changeFilter($store.dataTable.provinsi)" class="custom-select">
                                    <option value="">Filter Provinsi</option>
                                      @foreach($provinsis as $provinsi)
                                      <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                                      @endforeach
                                  </select>
                                </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                                <select x-model="$store.dataTable.kabupaten" @change="$store.dataTable.changeFilter" class="custom-select" x-bind:disabled="!$store.dataTable.provinsi">
                                  <option value="">Filter Kabupaten</option>
                                  <template x-for="kabupaten in $store.dataTable.kabupatens">
                                    <option x-bind:value="kabupaten.id" x-text="kabupaten.name"></option>
                                  </template>
                                </select>
                              </div>
                        </div>
                          <div class="col-md-4">
                              <button type="button" class="btn btn-primary float-right" style="color: #007bff" data-toggle="modal" data-target="#modal-default" @click="$store.dataTable.addData">
                                  <i class="fas fa-plus"></i><span> Tambah Penduduk</span>
                              </button>
                          </div>
                        </div>
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
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Timestamp</th>
                      </tr>
                      </thead>
                    </table>
                  </div>
                  <!-- /.card-body -->
              </div>
            </div>
          </div>
      </div><!-- /.container-fluid -->
      </div>
  </div>
  
  @push('js')
  <!-- date-range-picker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>

  <script>
      $('.datepicker').datepicker();

      $(".form-control-sm").removeAttr('placeholder')
      setTimeout(() => {
          $(".form-control-sm").attr("placeholder", "Nama/NIK Penduduk");
      }, 500);
  </script>
  <script type="text/javascript">
    
    const actionUrl = '{{ route('penduduk.store') }}';
    const kabupatenUrl = 'api/kabupaten/list';
    const url = `{{ url('penduduk') }}`;
    const store = '{{ route('penduduk.store') }}';
    const apiUrl = 'api/penduduk/list';
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
            'width': '100px',
            'orderable': false
        },
        {
            'data': 'name',
            'class': 'text-center',
            
            'orderable': true
        },
        {
            'data': 'nik',
            'class': 'text-center',
            
            'orderable': true
        },
        {
            'data': 'tgl_lahir',
            'class': 'text-center',
            
            'orderable': true
        },
        {
            'data': 'address',
            'class': 'text-center',
            
            'orderable': true
        },
        {
            'data': 'gender',
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

