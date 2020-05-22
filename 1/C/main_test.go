package main

import (
	"reflect"
	"testing"
)

func Test_generateSlice(t *testing.T) {
	type args struct {
		size int
		max  int
	}
	tests := []struct {
		name string
		args args
		want int
	}{
		{"Generate slice with 10 elements", args{10, 100}, 10},
		{"Generate slice with 100 elements", args{100, 100}, 100},
		{"Generate slice with 55 elements", args{55, 100}, 55},
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			if got := generateSlice(tt.args.size, tt.args.max); !reflect.DeepEqual(len(got), tt.want) {
				t.Errorf("generateSlice() = %v, want %v", len(got), tt.want)
			}
		})
	}
}

func Test_insertionSort(t *testing.T) {
	type args struct {
		items    []int
		showTime bool
	}
	tests := []struct {
		name string
		args args
		want []int
	}{
		{"Sort 5 elements", args{[]int{3, 4, 2, 6, 19}, false}, []int{2, 3, 4, 6, 19}},
		{"Sort 3 elements", args{[]int{99, 50, 20}, false}, []int{20, 50, 99}},
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			if got := insertionSort(tt.args.items, tt.args.showTime); !reflect.DeepEqual(got, tt.want) {
				t.Errorf("insertionSort() = %v, want %v", got, tt.want)
			}
		})
	}
}

func Benchmark_InsertSort_11(b *testing.B) {
	for i := 0; i < b.N; i++ {
		slice := generateSlice(11, 99)
		insertionSort(slice, false)
	}
}

func Benchmark_NativeSort_11(b *testing.B) {
	for i := 0; i < b.N; i++ {
		slice := generateSlice(11, 99)
		nativeSort(slice)
	}
}

func Benchmark_InsertSort_100000(b *testing.B) {
	for i := 0; i < b.N; i++ {
		slice := generateSlice(100000, 10000)
		insertionSort(slice, false)
	}
}

func Benchmark_NativeSort_100000(b *testing.B) {
	for i := 0; i < b.N; i++ {
		slice := generateSlice(100000, 10000)
		nativeSort(slice)
	}
}
