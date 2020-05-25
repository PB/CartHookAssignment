# CartHookAssignment

## C

### Task
Write a function that sorts 11 small numbers (<100) as fast as possible. Estimate how long it would take to execute that function 10 Billion (10^10) times on a normal machine?

### Solution
To run: `go run main.go` or `./bin/sorter`


### Test
`go test`

### Benchmark
`go test -bench=.`

Example output:

```
goos: darwin
goarch: amd64
pkg: github.com/PB/CartHookAssignment/1/C
Benchmark_InsertSort_11-8       	  113479	     10222 ns/op
Benchmark_NativeSort_11-8       	  109912	     10459 ns/op
Benchmark_InsertSort_100000-8   	       1	5203287990 ns/op
Benchmark_NativeSort_100000-8   	      54	  19923555 ns/op
PASS
ok  	github.com/PB/CartHookAssignment/1/C	9.048s
```

As you see insert sort for a small array is faster than a native sort function.
However, it is getting much slower for bigger arrays (here: 100000).

### 10 Billion
For one sort execution time is: ~600ns, so 10^10, should be ~1.7 hour