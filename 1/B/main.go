package main

import (
	"fmt"
	"os"
	"path/filepath"
	"regexp"
)

func main() {
	if len(os.Args) != 3 {
		fmt.Println("Please enter target directory and file: <target_directory>")
		os.Exit(0)
	}

	searchDir := os.Args[1]
	pattern := os.Args[2]

	fmt.Printf("Searching for %s in %s directory \n", pattern, searchDir)

	files := find(searchDir, pattern)
	fmt.Println(files)
	del(files)
	fmt.Println("Done")
}

// Find files that match pattern
func find(searchDir, pattern string) []string {
	var files []string

	// create regexp to find files matching pattern
	pathSeparator := string(os.PathSeparator)
	reg, _ := regexp.Compile(".*" + pathSeparator + pattern + "[^" + pathSeparator + "]*$")

	err := filepath.Walk(searchDir, func(path string, info os.FileInfo, err error) error {
		if !info.IsDir() && reg.MatchString(path) {
			files = append(files, path)
		}
		return nil
	})

	if err != nil {
		fmt.Println("Invalid directory")
		os.Exit(0)
	}

	return files
}

// *** For safety reason deleting is disabled ***
func del(files []string) {
	for _, file := range files {
		fmt.Println("Deleting...", file)
		//err := os.Remove(path)
		//if err != nil {
		//	fmt.Println(err)
		//}
	}
}
