@php
    // print_r($data);
    // print_r($constellation);
@endphp
@extends('app')
@section('content')
    <div class="container">
        <table class="table table-light">
            @for ($i = 0; $i < 12; $i++)
                <thead class="thead-light">
                    <tr>
                        <th>{!! $constellations[$i] !!}</th>
                    </tr>                
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                        @if (($key+1) % 4 == 0)
                            <tr>
                                <td>{!! $item !!}</td>
                            </tr>
                            @break
                        @else                           
                            <tr>
                                <td>{!! $item !!}</td>
                            </tr>   
                        @endif                           
                    @endforeach               
                </tbody>    
            @endfor           
        </table>
    </div>
@endsection