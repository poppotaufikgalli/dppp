		@php($title = $meta['title'] ?? "Website Dinas Pertanian Pangan dan Perikanan Kota Tanjungpinang")
		@php($description = $meta['description'] ?? "Dinas Pertanian Pangan dan Perikanan Kota Tanjungpinang adalah website resmi Dinas Pertanian Pangan dan Perikanan Pemerintah Kota Tanjungpinang yang Informasi Kegiatan Dinas Pertanian Pangan dan Perikanan di Kota Tanjungpinang")
		@php($img = $meta['image'] ?? 'assets/images/logo-tpi.png')
		@php($type = $meta['type'] ?? 'website')
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="{{$description}}" />
		<meta name="author" content="{{$title}}" />
		<meta property="og:url"           content="{{url()->full()}}" />
		<meta property="og:type"          content="{{$type}}" />
		<meta property="og:title"         content="{{$title}}" />
		<meta property="og:description"   content="{{$description}}" />
		<meta property="og:image"         content="{{asset($img)}}" />
		<title>@yield('title') :: {{env('APP_NAME')}}</title>