<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $package->track_number }}</title>
</head>
<body>
<div>
    <hr>
    <p style="text-align: center;">{{ $package->created_at }}</p>
    <hr>
    <table>
        <tbody>
            <tr>
                <td style="width: 60%">
                    <img src="data:image/png;base64, {{ $qrCode }}" alt="Red dot"/>
                </td>
                <td style="width: 40%; vertical-align: top;">
                    <span>Name: <span style="font-weight: bold">{{ $package->contact->name }}</span></span><br>
                    <span>Company: <span style="font-weight: bold">{{ $package->contact->company_name }}</span></span><br>
                    <br>
                    <span>Address: <span style="font-weight: bold">{{ $package->contact->address_line_1 }}</span></span><br>
                    <span><span style="font-weight: bold">{{ $package->contact->address_line_2 }}</span></span><br>
                    <span><span style="font-weight: bold">{{ $package->contact->address_line_3 }}</span></span><br>
                    <span>City: <span style="font-weight: bold">{{ $package->contact->city }}</span></span><br>
                    <span>State: <span style="font-weight: bold">{{ $package->contact->state }}</span></span><br>
                    <span>Country: <span style="font-weight: bold">{{ $package->contact->getFullCountry() }}</span></span><br>
                    <br>
                    <span>Email: <span style="font-weight: bold">{{ $package->contact->email }}</span></span><br>
                    <span>Phone: <span style="font-weight: bold">{{ $package->contact->phone }}</span></span><br>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    <div style="text-align: center; vertical-align: center">
        <img src="data:image/png;base64, {{ $barcode }}" alt="Red dot"/>
        <h4>{{ $package->track_number }}</h4>
    </div>
    <hr>
</div>
</body>
</html>
