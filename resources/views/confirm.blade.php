@extends('layouts.app')

@section('main')
<link rel="stylesheet" href="css/confirm.css">
<h1>内容確認</h1>
  <form action="{{ route('form.send') }}" method="post" name="contact-form" class="contact-form">
    @csrf
    <div class="row">
      <label class="form-title">お名前</label>
      {{ $form['last-name'] }}
      <span>　</span>
      {{ $form['first-name'] }}
      <input type="hidden" name="fullname" value="{{ $form['last-name'] }}{{ $form['first-name'] }}" />
      <input type="hidden" name="last-name" value="{{ $form['last-name'] }}" />
      <input type="hidden" name="first-name" value="{{ $form['first-name'] }}" />
    </div class="row">
    <div class="row">
      <span class="form-title">性別</span>
      @if ($form['gender'] === '1')
        <span>男性</span>
      @elseif ($form['gender'] === '2')
        <span>女性</span>
      @endif
      <input type="hidden" name="gender" value="{{ $form['gender'] }}" />
    </div>
    <div class="row">
      <label class="form-title">メールアドレス</label>
      {{ $form['email'] }}
      <input type="hidden" name="email" value="{{ $form['email'] }}" />
    </div>
    <div class="row">
      <label class="form-title">郵便番号</label>
      {{ $form['postcode'] }}
      <input type="hidden" name="postcode" value="{{ $form['postcode'] }}" />
    </div>
    <div class="row">
      <label class="form-title">住所</label>
      {{ $form['address'] }}
      <input type="hidden" name="address" value="{{ $form['address'] }}" />
    </div>
    <div class="row">
      <label class="form-title">建物名</label>
      {{ $form['building_name'] }}
      <input type="hidden" name="building_name" value="{{ $form['building_name'] }}" />
    </div>
    <div class="row">
      <span class="form-title">ご意見</span>
      <span class="opinion">{{ $form['opinion'] }}</span>
      <input type="hidden" name="opinion" value="{{ $form['opinion'] }}">
    </div>
    <div class="confirm">
      <button type="submit" name="action" value="post">送信</button><br>
      <button type="submit" name="action" value="back">修正する</button>
    </div>
  </form>
  @endsection
