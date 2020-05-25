package main

import (
	"fmt"
	"log"
	"math/rand"
	"sort"
	"time"
)

func main() {
	slice := generateSlice(11, 99)
	fmt.Println("Unsorted array: ", slice)
	insertionSort(slice, true)
	fmt.Println("Sorted array: ", slice)
}

// Generates a slice of size, size filled with random numbers
func generateSlice(size, max int) []int {
	slice := make([]int, size, size)
	rand.Seed(time.Now().UnixNano())
	for i := 0; i < size; i++ {
		slice[i] = rand.Intn(max)
	}
	return slice
}

// Simple insertion soring (fast for small arrays, slow for big)
func insertionSort(items []int, showTime bool) []int {
	if showTime {
		defer timeTrack(time.Now(), "insertionSort")
	}
	var n = len(items)
	for i := 1; i < n; i++ {
		j := i
		for j > 0 {
			if items[j-1] > items[j] {
				items[j-1], items[j] = items[j], items[j-1]
			}
			j = j - 1
		}
	}
	return items
}

func nativeSort(items []int) {
	sort.Ints(items)
}

// How long it took?
func timeTrack(start time.Time, name string) {
	elapsed := time.Since(start)
	log.Printf("%s took %s", name, elapsed)
}
