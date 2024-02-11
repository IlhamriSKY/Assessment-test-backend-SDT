<tr>
    <td>Name</td>
    <td>Email</td>
    <td>City</td>
    <td>Birthdate</td>
</tr>
@forelse($contacts as $contact)
    @if($contact->name!='')
    <tr>
        <td>{{$contact->name}}</td>
        <td>{{$contact->email}}</td>
        <td>{{$contact->city}}</td>
        <td>{{ \Carbon\Carbon::parse($contact->birthdate)->format('m-d-Y') }}</td>
    </tr>
    @endif
@endforeach
