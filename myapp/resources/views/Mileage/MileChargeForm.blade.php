<h2> 마일리지 충전 </h2>>

<hmtl>
    <body>


    @php (session('user_id') == null){
        return redirect()->back() ->with('alert', 'Updated!');
    }

    @endphp

    </body>
</hmtl>>
