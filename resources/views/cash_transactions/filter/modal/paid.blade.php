<div class="modal fade" id="paidModal" tabindex="-1">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="paidModalLabel">Daftar Pelajar Yang Sudah Membayar Pada Rentang Tanggal
					Tersebut</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					@isset($cashTransactions['studentsPaid'])
					@foreach ($cashTransactions['studentsPaid'] as $student)
					<div class="col-6">
						<div class="recent-message d-flex px-4 py-3">
							<div class="name ms-4">
								<h5 class="mb-1">
									{{ $loop->iteration }}. {{ $student->name }}</h5>
								<h6 class="text-muted mb-0">
									{{ $student->student_identification_number }}
								</h6>
							</div>
						</div>
					</div>
					@endforeach
					@endisset
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>