@extends('layouts/layoutMaster')

@section('title', 'Dashboard')

@section('content')
<h4 class="fw-bold py-3 mb-1">List Pengguna</h4>
<button id="toastbtn">click</button>
<p>For more layout options refer <a href="{{ config('variables.documentation') ? config('variables.documentation') : '#' }}" target="_blank" rel="noopener noreferrer">documentation</a>.</p>
@endsection
