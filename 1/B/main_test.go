package main

import (
	"reflect"
	"testing"
)

func Test_find(t *testing.T) {
	type args struct {
		searchDir string
		pattern   string
	}
	tests := []struct {
		name string
		args args
		want []string
	}{
		{
			"Find 0aH",
			args{"test_dir", "0aH"},
			[]string{"test_dir/0aHTest.txt", "test_dir/test_dir_1/test_dir_1/0aHTest1.txt", "test_dir/test_dir_1/test_dir_1/0aHTest2.txt", "test_dir/test_dir_2/0aHTest.txt"},
		},
		{
			"Find test",
			args{"test_dir", "test"},
			[]string{"test_dir/0aHTest_dir/test.txt", "test_dir/test.txt", "test_dir/test_dir_2/test.txt", "test_dir/test_main.go"},
		},
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			if got := find(tt.args.searchDir, tt.args.pattern); !reflect.DeepEqual(got, tt.want) {
				t.Errorf("find() = %v, want %v", got, tt.want)
			}
		})
	}
}
