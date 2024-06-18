@extends('layouts.app')

@php
    use App\Models\Account;
    $account = auth()->user()->account;
@endphp

@section('content')
    <div class="row justify-content-center">
        <div class="card" style="width: 95%;">
            <div class="card-body justify-content-center d-flex">
                <div style="width: 90%;" id="qw">
                    <div id="reader" width="600px" style="">

                    </div>
                    <div class="d-flex justify-content-center">
                        <a id="onCamera" class="btn btn-primary">Activar Camara</a>
                        <a id="bt" class="d-none" data-bs-target="#modalPayment" data-bs-toggle="modal">aa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modalPayment">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detalle</h1>
                </div>
                <form method="post" action="{{ route('scan') }}">
                    <div class="modal-body">
                        <input name="id" id="id" class="d-none">
                        @csrf
                        <div class="input-group">
                            <span class="input-group-text">Cuenta</span>
                            <input class="form-control" type="number" name="account" id="account" readonly>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Monto</span>
                            <input class="form-control" type="number" name="quantity" id="quantity" readonly>
                            <span class="input-group-text">Bs</span>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Saldo</span>
                            <input class="form-control" type="number" value="{{ $account->balance }}" readonly>
                            <span class="input-group-text">Bs</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('home') }}" type="button" class="btn btn-danger">Cancelar</a>
                        <button type="submit" class="btn btn-success">Completar Pago</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module">
        let html5QrcodeScanner = new window.Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            });

        function onScanSuccess(decodedText, decodedResult) {
            html5QrcodeScanner.clear();
            try {
                let qrData = JSON.parse(decodedText);
                if (qrData.account === undefined || qrData.quantity === undefined || qrData.id === undefined)
                    return Swal.fire({
                        title: "Vaya...",
                        text: "Parece que este QR no es Valido",
                        icon: "error",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Entiendo"
                    }).then((result) => {
                        window.location.href = "{{ route('home') }}";
                    });
                document.getElementById('id').value = qrData.id;
                document.getElementById('account').value = qrData.account;
                document.getElementById('quantity').value = qrData.quantity;
                document.getElementById('bt').click();

            } catch (e) {
                return Swal.fire({
                    title: "Vaya...",
                    text: "Parece que este QR no es Valido",
                    icon: "error",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Entiendo"
                }).then((result) => {
                    window.location.href = "{{ route('home') }}";
                });
            }
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        function activeCamera() {
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        }

        let btnCamera = document.getElementById('onCamera');
        btnCamera.addEventListener('click', () => {
            btnCamera.classList.add('d-none');
            activeCamera();
        });
    </script>
@endsection
