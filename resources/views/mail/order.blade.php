<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Dream House</title>
</head>
<body style='background-color:#739aaf; display:grid; justify-content:center: grid-column:1;height:100%;'>
    
    <h1 style='color:white; font:bold'>Grazie per il tuo ordine</h1>
    <div style="border:2px; border-radius:5px; border-color:white;">
        <h2 style='color:white'>Riepilogo ordine</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome prodotto</th>
                    <th>Quantità</th>
                    <th>Prezzo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderedproducts-> as $orderedproduct)
                <tr>
                    <th>
                        <h3>{{$orderedproduct->product->title}}</h3>
                    </th>
                    <th>
                        <h3>{{$orderedproduct->quantity}}</h3>
                    </th>
                </tr>
                @endforeach
            </tbody>
            
        </table>
            
        
    </div>

    </div>
    
</body>
</html>
