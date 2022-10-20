<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Document</title>
</head>
<body>

<table>
    <tbody>

    @foreach($data as $item)
        <tr>
            <td>{{ $item->name  }}</td>
            <td>{{ $item->date  }}</td>
            <td>{{ $item->cost  }}</td>
            <td>{{ $item->valute  }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<form method="post" action="http://127.0.0.1/dividends/api/set/shares">

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>
