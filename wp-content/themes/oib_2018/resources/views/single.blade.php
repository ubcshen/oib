<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5bbd360217814e0011c716f4&product=sticky-share-buttons' async='async'></script>
@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-single-'.get_post_type())
  @endwhile
@endsection
