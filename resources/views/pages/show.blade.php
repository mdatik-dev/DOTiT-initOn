@extends('layouts.site')
@section('title', $pageTitle.' | '.$siteSettings['site_name'])
@section('content')
  @include('sections.'.$currentPage)
  @unless($currentPage === 'contact')
    @include('partials.cta')
  @endunless
@endsection
