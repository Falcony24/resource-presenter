@props(["info" => "error"])

<h1>TEST</h1>
<h6>
    <table>

    @foreach($info as $item)
        <tr>

        @php
            $itemArr = (array) $item;
            $descArr = (array) $item->Description;
            if($itemArr["@value"] === "All_Indicators" || $descArr["#text"] === "All Indicators"){
//            if($descArr["#text"] === "All Indicators"){
                continue;
            }
        @endphp
            <td>

        {{ $itemArr["@value"] }}
            </td>
            <td>
        @php
            $tmp = "";

            if(substr($descArr["#text"], 0, 26) === "Primary Commodity Prices, "){
                $tmp = substr($descArr["#text"], 26, strlen($descArr["#text"]) - 26);
            } else {
                $tmp = $descArr["#text"];
            }

            echo $tmp;
        @endphp
            </td>
        </tr>
    @endforeach
    </table>
</h6>
