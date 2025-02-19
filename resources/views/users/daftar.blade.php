@extends('layouts/commonMaster')

@section('layoutContent')
@include('layouts.sections.navbar.navbar-user')


<head>
    <title>Pendaftaran Diklat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafc;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h1,
        h3 {
            font-weight: 700;
        }

        .form-container {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .form-container:hover {
            transform: translateY(-5px);
        }

        .form-container input {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
            padding: 10px;
        }

        .btn-submit {
            background-color: #007bff;
            border: none;
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 50px;
            transition: background 0.3s, box-shadow 0.3s;
        }

        .btn-submit:hover {
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .info-section {
            background: linear-gradient(135deg, #e6f1ff, #ffffff);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .info-section h1 {
            color: #007bff;
        }

        .info-section .highlight {
            font-size: 1.3rem;
            font-weight: bold;
            color: #dc3545;
            text-transform: uppercase;
        }

        .info-section p {
            line-height: 1.8;
            font-size: 1rem;
        }

        .icon-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .icon-wrapper i {
            font-size: 24px;
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">PENDAFTARAN DIKLAT</h1>
        <div class="row g-4">
            <!-- Form Section -->
            <div class="col-md-6">
            <div class="form-container">
                <h3 class="mb-3 icon-wrapper"><i class='bx bx-id-card'></i> Masukan NIK</h3>
                <form action="{{ route('users.form-daftar') }}" method="GET">
                    @csrf
                    <input type="hidden" name="id_diklat" value="{{ $diklat->id_diklat }}">
                    <input type="text" name="nik" id="nik" class="form-control mb-3" maxlength="16" required>
                    <button type="submit" class="btn btn-submit w-100">Submit</button>
                </form>
            </div>
            </div>
            <!-- Information Section -->
            <div class="col-md-6">
                <div class="info-section">
                    <h1 class="mb-3">Diklat yang Akan Anda Ikuti:</h1>
                    <p class="highlight">{{ $diklat->nama_diklat }}</p>
                    <p>
                        Untuk mengikuti bimbingan teknis (bimtek), anda harus menginputkan NIK terlebih dahulu di form bagian kiri.
                        Jika sudah anda inputkan, sistem kami otomatis akan mengecek data NIK anda apakah sudah tersedia atau belum pada database kami.
                        <em>Jika belum tersedia maka, nantinya anda akan diarahkan ke halaman pengisian form data diri pendaftaran bimtek;</em>
                        dan jika <strong>NIK anda sudah tersedia</strong>, data diri anda akan otomatis ditampilkan dari data yang sudah kami miliki sebelumnya.
                        Setelah itu, anda hanya perlu melanjutkan proses pendaftaran bimtek dengan mengklik tombol daftar.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
document.getElementById('nik').addEventListener('input', function() {
    const nik = this.value.trim();
    const errorDiv = document.getElementById('nik-error');
    
    // Clear previous error
    if (errorDiv) {
        errorDiv.remove();
    }
    
    if (nik.length === 16) {
        fetch(`/users/cek-nik/${nik}`, {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                // Show error message but still allow form submission for new registration
                const div = document.createElement('div');
                div.id = 'nik-error';
                div.className = 'alert alert-warning mt-2';
                div.textContent = data.message;
                this.parentNode.appendChild(div);
                
                // Submit form after 2 seconds to show the message
                setTimeout(() => {
                    this.closest('form').submit();
                }, 2000);
            } else {
                // If success (existing user), submit form immediately
                this.closest('form').submit();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const div = document.createElement('div');
            div.id = 'nik-error';
            div.className = 'alert alert-danger mt-2';
            div.textContent = 'Terjadi kesalahan saat memverifikasi NIK';
            this.parentNode.appendChild(div);
        });
    }
});
</script>



@include('layouts.sections.footer.footer-user')
@endsection