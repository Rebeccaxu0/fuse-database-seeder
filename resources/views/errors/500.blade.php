@extends('errors::fuse')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __("Uh oh... Well that was unexpected. You may have found a bug. Please try something different next time. If this persists, please contact your facilitator."))
