<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Subscriber Name</th>
                <th>Complaints</th>
                <th>Reply</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($complaints as $complaint)
                <tr>
                    <td>{{ $complaint->subscriber->name }}</td>
                    <td>{{ $complaint->description }}</td>
                    <td>{{ $complaint->cp_reply }}</td>
                    <td>
                        <button wire:click="selectComplaint({{ $complaint->id }})">Select</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($selectedcomplaints)
        <div>
            <h3>Reply to Complaint</h3>
            <textarea wire:model="reply"></textarea>
            <button wire:click="replyComplaints">Submit Reply</button>
        </div>
    @endif
</div>
