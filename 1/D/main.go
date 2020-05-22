package main

import (
	"log"
	"math/big"
	"math/rand"
	"time"
)

func main() {
	slice := generateSlice(10000, 100, 10000)
	selectionSort(slice)
}

// Generates a slice of size, size filled with random numbers
func generateSlice(size int, min, max int64) []*big.Int {
	defer timeTrack(time.Now(), "generateSlice")
	slice := make([]*big.Int, size, size)
	rand.Seed(time.Now().UnixNano())
	for i := 0; i < size; i++ {
		a := rand.Int63n(max-min+1) + min
		b := rand.Int63n(max-min+1) + min
		slice[i] = new(big.Int).Exp(big.NewInt(a), big.NewInt(b), nil)
	}
	return slice
}

// Selection sort
func selectionSort(items []*big.Int) []*big.Int {
	defer timeTrack(time.Now(), "selectionSort")

	var n = len(items)
	for i := 0; i < n; i++ {
		var minIdx = i
		for j := i; j < n; j++ {
			if items[j].Cmp(items[minIdx]) == -1 {
				minIdx = j
			}
		}
		items[i], items[minIdx] = items[minIdx], items[i]
	}

	return items
}

// How long it took?
func timeTrack(start time.Time, name string) {
	elapsed := time.Since(start)
	log.Printf("%s took %s", name, elapsed)
}
