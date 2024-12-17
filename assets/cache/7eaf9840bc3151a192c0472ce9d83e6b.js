
	var myBar, myPie;
	var serialize_color = [
		'#404E67',
		'#22C2DC',
		'#ff6384',
		'#ff9f40',
		'#ffcd56',
		'#4bc0c0',
		'#9966ff',
		'#36a2eb',
		'#848484',
		'#e8b892',
		'#bcefa0',
		'#4dc9f6',
		'#a0e4ef',
		'#c9cbcf',
		'#00A5A8',
		'#10C888'
	];
	function get_chart(e) {
		$.ajax({
			url 		: base_url + 'home/welcome/chart_data',
			data 		: {tahun:$('#tahun').val(), id_department: $('#id_department').val()},
			type 		: 'post',
			dataType	: 'json',
			success 	: function(response) {
				var label_chart 	= [];
				var data_bar_l 		= [];
				var data_bar_p 		= [];
				$.each(response,function(k,v){
					label_chart.push(response[k]['bulan']);
					data_bar_l.push(parseInt(response[k]['open']));
					data_bar_p.push(parseInt(response[k]['close']));
				});
				
				myBar.data = {
					labels: label_chart,
					datasets: [{
						label: 'Permasalahan',
						backgroundColor: 'rgba(255, 117, 136, .8)',
						borderColor: 'transparent',
						borderWidth: 0,
						data: data_bar_l
					},{
						label: 'Tiket Selesai',
						backgroundColor: 'rgba(34, 194, 220,.8)',
						borderColor: 'transparent',
						borderWidth: 0,
						data: data_bar_p
					}]
				};

				myBar.update();
				if(typeof e != 'undefined' && e == 'category') {
					get_category();
				}
			}
		});
	}
	function get_category() {
		$.ajax({
			url 		: base_url + 'home/welcome/get_category',
			data 		: {periode:$('#periode').val()},
			type 		: 'post',
			dataType	: 'json',
			success 	: function(response) {
				var data_pie 		= [];
				var color_pie 		= [];
				var label_chart 	= [];
				$.each(response,function(k,v){
					data_pie.push(parseInt(v['jml']));
					color_pie.push(serialize_color[k]);
					label_chart.push(v['kategori']);
				});
				myPie.data = {
					datasets: [{
						data: data_pie,
						backgroundColor: color_pie,
						label: 'Kategori'
					}],
					labels: label_chart,
				};
				myPie.update();
			}
		});
	}
	$(document).ready(function(){
		var ctxBar  	= document.getElementById('myChart').getContext('2d');
		myBar 			= new Chart(ctxBar, {
			type: 'bar',
			options: {
				maintainAspectRatio: false,
				responsive: true,
				legend: {
					position: 'bottom',
				}
			}
		});

		var ctxPie = document.getElementById('pieChart').getContext('2d');
		myPie = new Chart(ctxPie, {
			type: 'pie',
			options: {
				maintainAspectRatio: false,
				responsive: true,
				legend: {
					display: true,
					position: 'right',
					labels: {
						boxWidth: 15,
						generateLabels: function(chart) {
							var data = chart.data;
							if (data.labels.length && data.datasets.length) {
								return data.labels.map(function(label, i) {
									var meta = chart.getDatasetMeta(0);
									var ds = data.datasets[0];
									var arc = meta.data[i];
									var custom = arc && arc.custom || {};
									var getValueAtIndexOrDefault = Chart.helpers.getValueAtIndexOrDefault;
									var arcOpts = chart.options.elements.arc;
									var fill = custom.backgroundColor ? custom.backgroundColor : getValueAtIndexOrDefault(ds.backgroundColor, i, arcOpts.backgroundColor);
									var stroke = custom.borderColor ? custom.borderColor : getValueAtIndexOrDefault(ds.borderColor, i, arcOpts.borderColor);
									var bw = custom.borderWidth ? custom.borderWidth : getValueAtIndexOrDefault(ds.borderWidth, i, arcOpts.borderWidth);

									var value = chart.config.data.datasets[arc._datasetIndex].data[arc._index];

									return {
										text: label + " : " + value,
										fillStyle: fill,
										strokeStyle: stroke,
										lineWidth: bw,
										hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
										index: i
									};
								});
							} else {
								return [];
							}
						}
					}
				}
			}
		});
		get_chart('category');
	});
	$('#tahun,#id_department').change(function(){
		get_chart();
	});
	$('#periode').change(function(){
		get_category();
	});
	$("#bn7").breakingNews({
		effect		:"slide-v",
		autoplay	:true,
		timer		:5000,
	});
