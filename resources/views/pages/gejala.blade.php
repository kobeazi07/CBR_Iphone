@extends('layouts.index')

@section('konten')

<div class="container">
          <div class="page-inner">
            <div class="container-fluid">
                            <div class="row page-titles mx-0">
                                <div class="col-sm-6 p-md-0">
                                    <div class="welcome-text">
                                        <h4>Gejala</h4>
                                    
                                    </div>
                                </div>
                                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Datatable</a></li>
                                    </ol>
                                </div>
                            </div>
                            <!-- row -->


                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header d-flex">
                                        
                                                <div class="col-lg-6">
                                                    <h4 class="card-title">Basic Datatable</h4>
                                                    
                                                </div>
                                                <div class="col-lg-6 float-end">
                                                
                                                <!-- Large modal -->
                                              <!-- Large modal -->
                                               <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambah">Tambah Program</button>
                                              <!-- tambahmodal -->
                                    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('AdminTambahgejala')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="" class="mb-2 text-secondary">Kode</label>
                                                    <input class="form-control form-control-lg" name="kode" type="text" placeholder="masukkan Kode">
                                                    </div>
                                                     <div class="form-group">
                                                        <label for="" class="mb-2 text-secondary">Gejala</label>
                                                    <input class="form-control form-control-lg" name="nama_gejala" type="text" placeholder="masukkan gejala">
                                                    </div>
                                                     <div class="form-group">
                                                        <label for="" class="mb-2 text-secondary">Bobot</label>
                                                    <input class="form-control form-control-lg" name="bobot" type="number" placeholder="masukkan bobt">
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                    </form>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        <!-- akhir modal -->
                                   
                                            
                                            </div>
                                        </div>


                                        <!-- table -->
                                         <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                <th scope="col">No</th>
                                                       <th scope="col">Kode</th>
                                                <th scope="col">Gejala</th>
                                                <th scope="col">Bobot</th>
                                                <th scope="col">Aksi</th>
                                              
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($gejala as $key=>$jenis)
                                                <tr>
                                                    <td scope="row">{{$key+1}}</td>
                                                        <td>{{$jenis->kode}}</td>
                                                    <td>{{$jenis->nama_gejala}}</td>
                                                      <td>{{$jenis->bobot}}</td>
                                                    <td>    

                                                      <button type="button" class="btn btn-danger float-right ml-3 " data-toggle="modal"  data-target="#hapus-{{$jenis->id}}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                            </svg>
                                                        </button>
                                                        <button type="button" class="btn btn-warning float-right " data-toggle="modal" data-target="#edit-{{$jenis->id}}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                            </svg>
                                                        </button>
                                                    </td>
                                              
                                                </tr>
                                                  <div class="modal fade"  id="edit-{{$jenis->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <!-- <div class="modal " id="edit-{{$jenis->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Jenis</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                        
                                            <form action="{{route('AdminEditgejala', $jenis)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="" class="mb-2 text-secondary">Kode</label>
                                                    <input class="form-control form-control-lg" name="kode" type="text" value="{{$jenis->kode}}" placeholder="masukkan Kode">
                                                    </div>
                                                     <div class="form-group">
                                                        <label for="" class="mb-2 text-secondary">Gejala</label>
                                                    <input class="form-control form-control-lg" name="nama_gejala" value="{{$jenis->nama_gejala}}" type="text" placeholder="masukkan gejala">
                                                    </div>
                                                     <div class="form-group">
                                                        <label for="" class="mb-2 text-secondary">Bobot</label>
                                                    <input class="form-control form-control-lg" name="bobot" value="{{$jenis->bobot}}" type="number" placeholder="masukkan bobt">
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                   
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                           <!-- akhir modal edit -->
                                         
                                    </div>
                                       <!-- modal hapus -->
                                             <div class="modal fade" id="hapus-{{$jenis->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Yakin Ingin Hapus Data?
                                                    </div>
                                                    <div class="modal-footer">
                                                    <form action="{{route('gejala.destroy', $jenis->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="btn btn-danger">Ya</button>
                                                        </form>
                                                    </div>

                                                    </div>
                                                </div>
                                                </div>
                                             <!--  akhir modal hapus-->
                                            @endforeach
                                            </tbody>
                                            </table>

                                         <!-- end table -->

                                          <!-- modal edit -->
                                  
                                </div>
                            
                            </div>
                        </div>
        </div>
</div>

<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
</script>    

@endsection