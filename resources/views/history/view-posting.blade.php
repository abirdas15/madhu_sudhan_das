<table class="table table-bordered">
        <thead>
            <tr>
                <th>Group Name</th>
                <th class="text-center">Group Type</th>
                <th class="text-center">Account Name</th>
                <th>Post Text</th>
                <th class="text-center">Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bufferPosting as $row)
            <tr>
                <td>{{ $row->groupInfo['name'] }}</td>
                <td class="text-center">{{ $row->groupInfo['type'] }}</td>
                <td class="text-center"><img width="50px" style="border-radius: 50%;" src="{{ asset($row->accountInfo['avatar']) }}"></td>
                <td>{{ $row->post_text }}</td>
                <td>{{  date("d M, Y H:i a", strtotime($row->sent_at)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
            {{ $bufferPosting->links() }}
        </div>