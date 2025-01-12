@extends('layouts.index')

@section('konten')

<div class="container">
    <div class="row">
        
    </div>
          <div class="page-inner">
            <div class="container-fluid">
                            <div class="row page-titles mx-0">
                                <div class="col-sm-6 p-md-0">
                                    <div class="welcome-text">
                                        <h4>Prediksi</h4>
                                    
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


                           <div class="row bg-white p-5">
                                
                                <form  id="diagnosaForm">
                                 @csrf
                                    <div class="form-group">
                                        <label for="gejala" class="form-label">Pilih Gejala:</label>
                                        <select name="gejala[]" id="gejala" class="form-control" multiple>
                                            @foreach($gejala as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_gejala }}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">Gunakan fitur pencarian untuk mempermudah memilih gejala.</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Diagnosa</button>
                                </form>

 <div id="result">
                <!-- Hasil JSON akan ditampilkan di sini -->
            </div>
                           </div>
                        </div>
        </div>
</div>


 <script>
    //  document.getElementById('diagnosaForm').addEventListener('submit', function (e) {
    //     e.preventDefault(); // Mencegah form refresh halaman

    //     // Ambil data dari form
    //     const formData = new FormData(this);

    //     // Kirim data ke server
    //     fetch('{{ route("Predict") }}', {
    //         method: 'POST',
    //         headers: {
    //             'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
    //         },
    //         body: formData
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         // Tampilkan hasil JSON
    //         const resultDiv = document.getElementById('result');
    //         resultDiv.innerHTML = '';

    //         if (data.message) {
    //             resultDiv.innerHTML = `<div class="alert alert-warning">${data.message}</div>`;
    //         } else {
    //             resultDiv.innerHTML = `
    //                 <div class="alert alert-success">
    //                     <h5>Hasil Diagnosa</h5>
    //                     <p><strong>Kerusakan:</strong> ${data.kerusakan}</p>
    //                     <p><strong>Solusi:</strong> ${data.solusi}</p>
    //                     <p><strong>Similarity:</strong> ${(data.similarity * 100).toFixed(2)}%</p>
    //                 </div>
    //             `;
    //         }
    //     })
    //     .catch(error => {
    //         console.error('Error:', error);
    //         document.getElementById('result').innerHTML = `
    //             <div class="alert alert-danger">Terjadi kesalahan saat mengirim data.</div>
    //         `;
    //     });
    // });
document.getElementById('diagnosaForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Mencegah form refresh halaman

    // Ambil data dari form
    const formData = new FormData(this);

    // Kirim data ke server
    fetch('{{ route("Predict") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Tampilkan hasil JSON
        const resultDiv = document.getElementById('result');
        resultDiv.innerHTML = '';
        console.log('data',data);
        if (data.message) {
            resultDiv.innerHTML = `<div class="alert alert-warning">${data.message}</div>`;
        } else {
            resultDiv.innerHTML = `
                <div class="alert alert-success">
                    <h5>Hasil Diagnosa</h5>
                    <p><strong>Kerusakan:</strong> ${data.kerusakan}</p>
                    <p><strong>Solusi:</strong> ${data.solusi}</p>
                    <p><strong>Similarity:</strong> ${(data.similarity)}</p>
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('result').innerHTML = `
            <div class="alert alert-danger">Terjadi kesalahan saat mengirim data.</div>
        `;
    });
});

    
    $(document).ready(function() {
          console.log($('#gejala').length);
        $('#gejala').select2({
            placeholder: "Pilih gejala yang sesuai",
            allowClear: true
        });
    });

</script>

@endsection