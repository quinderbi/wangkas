<script>
	$(function () {
		const table = $('#table').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('api.v1.datatables.students.index') }}",
			columns: [
				{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
				{ data: 'student_identification_number', name: 'student_identification_number' },
				{ data: 'name', name: 'name' },
				{ data: 'school_class.name', name: 'school_class_id' },
				{ data: 'school_major', name: 'school_major' },
				{ data: 'school_year', name: 'school_year' },
				{ data: 'action', name: 'action' }
			]
		});

		$('#createModal form').submit(function (e) {
			e.preventDefault();

			const formData = {
				name: $('#createModal form #name').val()
			};

			$.ajax({
				url: "{{ route('api.v1.datatables.students.store') }}",
				method: 'POST',
				header: {
					'Content-Type': 'application/json'
				},
				data: formData,
				success: res => {
					table.ajax.reload();
					$('#createModal').modal('hide');

					Swal.fire({
						icon: 'success',
						title: 'Data kelas berhasil ditambahkan!',
						toast: true,
						position: 'top-end',
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter', Swal.stopTimer)
							toast.addEventListener('mouseleave', Swal.resumeTimer)
						}
					});
				},
				error: err => {
					alert('error occured, check console');
					console.log(err);
				}
			});
		});

		$('#table').on('click', '.show-modal', function () {
			const id = $(this).data('id');
			let url = "{{ route('api.v1.datatables.students.show', ':paramID') }}".replace(':paramID', id);

			$.ajax({
				url: url,
				method: 'GET',
				header: {
					'Content-Type': 'application/json'
				},
				success: res => {
					$('#showModal form #name').val(res.data.name);
				},
				error: err => {
					alert('error occured, check console');
					console.log(err);
				}
			});
		});

		$('#table').on('click', '.update-modal', function () {
			const id = $(this).data('id');
			let url = "{{ route('api.v1.datatables.students.show', ':paramID') }}".replace(':paramID', id);
			let updateURL = "{{ route('api.v1.datatables.students.update', ':paramID') }}".replace(':paramID', id);

			$.ajax({
				url: url,
				method: 'GET',
				header: {
					'Content-Type': 'application/json'
				},
				success: res => {
					$('#updateModal form #name').val(res.data.name);
					$('#updateModal form').attr('action', updateURL);
				},
				error: err => {
					alert('error occured, check console');
					console.log(err);
				}
			});
		});

		$('#updateModal form').submit(function (e) {
			e.preventDefault();

			const formData = {
				name: $('#updateModal form #name').val()
			};

			const updateURL = $('#updateModal form').attr('action');

			$.ajax({
				url: updateURL,
				method: 'PUT',
				header: {
					'Content-Type': 'application/json'
				},
				data: formData,
				success: res => {
					table.ajax.reload();
					$('#updateModal').modal('hide');

					Swal.fire({
						icon: 'success',
						title: 'Data kelas berhasil diubah!',
						toast: true,
						position: 'top-end',
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter', Swal.stopTimer)
							toast.addEventListener('mouseleave', Swal.resumeTimer)
						}
					});
				},
				error: err => {
					alert('error occured, check console');
					console.log(err);
				}
			});
		});

		$('#table').on('click', '.delete', function (e) {
			e.preventDefault()

			Swal.fire({
				title: 'Hapus?',
				text: "Data tersebut akan dihapus!",
				icon: 'warning',
				showCancelButton: true,
				reverseButtons: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Tidak',
				confirmButtonText: 'Ya!'
			}).then((result) => {
				if (result.isConfirmed) {
					const id = $(this).data('id');
					const url = "{{ route('api.v1.datatables.students.destroy', ':paramID') }}".replace(':paramID', id);

					$.ajax({
						url: url,
						method: 'DELETE',
						success: res => {
							Swal.fire({
								icon: 'success',
								title: 'Data berhasil dihapus!',
								toast: true,
								position: 'top-end',
								showConfirmButton: false,
								timer: 3000,
								timerProgressBar: true,
								didOpen: (toast) => {
									toast.addEventListener('mouseenter', Swal.stopTimer)
									toast.addEventListener('mouseleave', Swal.resumeTimer)
								}
							})

							table.ajax.reload();
						}
					});
				}
			})
		});

		$('.modal').on('hidden.bs.modal', function () {
			$(this).find('form :input').val('');
		});

		$('.modal').on('shown.bs.modal', function () {
			$(this).find('input:first').focus();
		});
	});
</script>
