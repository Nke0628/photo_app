@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('あなたのメールアドレスを確認してください') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('新しい確認リンクがあなたのメールアドレスに送信されました。') }}
                        </div>
                    @endif

                    {{ __('続行する前に、確認リンクがあるかどうか電子メールを確認してください。') }}<br>
                    {{ __('Eメールを受け取らなかった場合は') }}, <a href="{{ route('verification.resend') }}">{{ __('ここをクリックして別のものを要求してください。') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
