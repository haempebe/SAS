@extends('layouts.app')

@section('content')
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-lock-square-rounded">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path>
                    <path d="M8 11m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z"></path>
                    <path d="M10 11v-2a2 2 0 1 1 4 0v2"></path>
                </svg>
            </div>
            <form class="card card-md" action="./" method="get" autocomplete="off" novalidate="">
                <div class="card-body">
                    <h2 class="card-title card-title-lg text-center mb-4">Terkunci</h2>
                    <p class="my-4 text-center">Masukan <b>PIN</b> untuk membuka rekap absen tendik.</p>
                    <div class="my-5">
                        <div class="row g-4">
                            <div class="col">
                                <div class="row g-2">
                                    <div class="col">
                                        <input type="text" class="form-control form-control-lg text-center py-3"
                                            maxlength="1" inputmode="numeric" pattern="[0-9]*" data-code-input="">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-lg text-center py-3"
                                            maxlength="1" inputmode="numeric" pattern="[0-9]*" data-code-input="">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-lg text-center py-3"
                                            maxlength="1" inputmode="numeric" pattern="[0-9]*" data-code-input="">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row g-2">
                                    <div class="col">
                                        <input type="text" class="form-control form-control-lg text-center py-3"
                                            maxlength="1" inputmode="numeric" pattern="[0-9]*" data-code-input="">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-lg text-center py-3"
                                            maxlength="1" inputmode="numeric" pattern="[0-9]*" data-code-input="">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-lg text-center py-3"
                                            maxlength="1" inputmode="numeric" pattern="[0-9]*" data-code-input="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-footer">
                        <a href="#" class="btn btn-primary w-100">
                            Buka
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var inputs = document.querySelectorAll('[data-code-input]');
            // Attach an event listener to each input element
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].addEventListener('input', function(e) {
                    // If the input field has a character, and there is a next input field, focus it
                    if (e.target.value.length === e.target.maxLength && i + 1 < inputs.length) {
                        inputs[i + 1].focus();
                    }
                });
                inputs[i].addEventListener('keydown', function(e) {
                    // If the input field is empty and the keyCode for Backspace (8) is detected, and there is a previous input field, focus it
                    if (e.target.value.length === 0 && e.keyCode === 8 && i > 0) {
                        inputs[i - 1].focus();
                    }
                });
            }
        });
    </script>
@endsection
