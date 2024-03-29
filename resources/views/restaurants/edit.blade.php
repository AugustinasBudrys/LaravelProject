@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row'>
            <div class='col-md-12'>
                <h2 class='mt-4'>Add Restaurant</h2>
                <hr>
                <form action="{{route('restaurants.update', ['restaurant'=> $restaurant->id])}}" method='POST'>
                    {{method_field('PUT')}}
                    @csrf
                    <div class='col-md-5 pl-0'>
                        <div class='form-group'>
                            <label for='restaurant-name'>Restaurant name</label>
                            <input type='text' id='restaurant-name' name='name' value='{{$restaurant->name}}' class='form-control' placeholder='Name'>
                        </div>
                    </div>
                    <div class='d-md-flex flex-row'>
                        <div class='form-group mr-2'>
                            <label for='from'>From</label>
                            <input type='time' name='work_time_from' id='from' value='{{$restaurant->work_time_from}}' class='form-control' placeholder='time'>
                        </div>
                        <div class='form-group mr-4'>
                            <label for='to'>To</label>
                            <input type='time' class='form-control' id='to' value='{{$restaurant->work_time_to}}' name='work_time_to'>
                        </div>
                        <div class='form-group mr-4'>
                            <label for='location'>Location</label>
                            <input type='text' class='form-control' id='location' value='{{$restaurant->address}}' name='address'
                                   placeholder='Enter Location'>
                        </div>
                        <div class='form-group mr-4'>
                            <label for='tel'>Telephone</label>
                            <input class='form-control' type='tel' id='tel' value='{{$restaurant->phone_number}}' name='phone_number'
                                   placeholder='Enter Telephone'>
                        </div>
                        <div class='form-group mr-4'>
                            <label for='url'>URL</label>
                            <input class='form-control' type='url' id='url' value='{{$restaurant->URL}}' name='URL' placeholder='Enter URL'>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='description'>Restaurant Description</label>
                        <textarea class='form-control' id='description'  name='description' rows='3'>'{{$restaurant->description}}'</textarea>
                    </div>
                    <div class='d-flex justify-content-center'>
                        <button type='submit' class='btn btn-primary mr-5'>Submit</button>
                        <a href="{{route('restaurant.description',['restaurant' => $restaurant->id])}}"
                           class='btn btn-primary'>Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
