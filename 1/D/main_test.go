package main

import (
	"math/big"
	"reflect"
	"testing"
)

func Test_generateSlice(t *testing.T) {
	type args struct {
		size int
		min  int64
		max  int64
	}
	tests := []struct {
		name string
		args args
		want int
	}{
		{"10 array", args{10, 100, 10000}, 10},
		{"10000 array", args{10000, 100, 10000}, 10000},
		{"100000 array", args{100000, 100, 10000}, 100000},
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			if got := generateSlice(tt.args.size, tt.args.min, tt.args.max); !reflect.DeepEqual(len(got), tt.want) {
				t.Errorf("generateSlice() = %v, want %v", len(got), tt.want)
			}
		})
	}
}

func Test_selectionSort(t *testing.T) {
	type args struct {
		items []*big.Int
	}
	x10, x20, x30 := new(big.Int), new(big.Int), new(big.Int)
	x10.SetString("1000000000000000000000", 10)
	x20.SetString("2000000000000000000000", 10)
	x30.SetString("3000000000000000000000", 10)

	tests := []struct {
		name string
		args args
		want []*big.Int
	}{
		{"basic", args{[]*big.Int{x30, x10, x20}}, []*big.Int{x10, x20, x30}},
		{"basic", args{[]*big.Int{x20, x10, x30}}, []*big.Int{x10, x20, x30}},
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			if got := selectionSort(tt.args.items); !reflect.DeepEqual(got, tt.want) {
				t.Errorf("selectionSort() = %v, want %v", got, tt.want)
			}
		})
	}
}
