<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Редактирование даты отпуска
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
					@if($vacation->approved)
						<div>Дата отпуска зафиксирована вашим руководителем, её нельзя изменить</div>
					@endif
					<form method="POST">
						@csrf
						<div>
							<input type="date" name="start" value="{{$vacation->start_date}}" min="{{Carbon\Carbon::now()->toDateString()}}" @if($vacation->approved) disabled @endif>
							<input type="date" name="end" value="{{$vacation->end_date}}" min="{{Carbon\Carbon::now()->toDateString()}}" @if($vacation->approved) disabled @endif>
						</div>
						<div class="mt1">
							<input type="submit" value="Сохранить">
						</div>
					</form>
            </div>
        </div>
    </div>
</x-app-layout>