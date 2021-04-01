<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
					@if(Session::has('success'))
						<div class="alert alert-success">{{ Session::get('success') }}</div>
					@endif
					@if(Session::has('warning'))
						<div class="alert alert-warning">{{ Session::get('warning') }}</div>
					@endif
					<table>
						<thead>
							<td>Работник</td>
							<td>Дата начала</td>
							<td>Дата окончания</td>
							<td>Подтверждено</td>
							@if(Auth::user()->leader)<td>Утвердить</td>@endif
						</thead>
						<tbody>
							@foreach($vacations as $vac)
								<tr @if(Auth::id() == $vac->user_id) class="curr-user-row" @endif>
									<td>{{$vac->user->fullname}}</td>
									<td>{{$vac->start_date ? Carbon\Carbon::parse($vac->start_date)->format('d.m.Y') : 'Н.д.'}}</td>
									<td>{{$vac->end_date ? Carbon\Carbon::parse($vac->end_date)->format('d.m.Y') : 'Н.д.'}}</td>
									<td>{{$vac->approvedText}}</td>
									@if(Auth::user()->leader)
										<td>
										@if($vac->start_date && $vac->end_date && !$vac->approved)
											<a href="/vacation/{{$vac->id}}/approve"><button>Зафиксировать</button></a>
										@endif
											
										</td>
									@endif
								</tr>
							@endforeach
						</tbody>
					</table>
                </div>
				@if(!Auth::user()->vacation->approved)
					<div>
						<a href="/vacation">Запланировать дату отпуска</a>
					</div>
				@endif
            </div>
        </div>
    </div>
</x-app-layout>