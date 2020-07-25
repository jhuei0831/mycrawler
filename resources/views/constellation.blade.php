@php
    // print_r($data);
    // print_r($constellation);
@endphp
@extends('app')
@section('content')
    @php
        // foreach ($constellations as $key => $value) {
        //     echo $value->constellation;
        // }
        // print_r($datas);
    @endphp
    <div class="container">
        <table class="table table-light">
            @foreach ($datas as $data)
                <thead class="thead-light">
                    <tr>
                        <th>Date</th>
                        <th>{!! $data->constellation !!}</th>
                    </tr>                
                </thead>
                <tbody>
                    @for ($i = 0; $i < count(json_decode($data->fortune)); $i++)
                        <tr>
                            {{-- <td>{{ \Carbon\Carbon::now()->format('m/d') }}</td> --}}
                            <td>{{ $data->date }}</td>
                            <td>{!! json_decode($data->fortune)[$i] !!}</td>
                        </tr>
                    @endfor
                </tbody>  
            @endforeach          
        </table>
    </div>
@endsection